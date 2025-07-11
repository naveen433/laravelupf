<?php
namespace App\Services;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Repositories\Interfaces\LoanRepositoryInterface;
use App\Repositories\Interfaces\EmiRepositoryInterface;

class EmiService
{
    protected $loanRepository;
    protected $emiRepository;

    public function __construct(
        LoanRepositoryInterface $loanRepository,
        EmiRepositoryInterface $emiRepository
    ) {
        $this->loanRepository = $loanRepository;
        $this->emiRepository = $emiRepository;
    }

    public function getEmiTableData()
    {
        $tableExists = $this->emiRepository->checkTableExists('emi_details');
        $columns = [];
        $data = [];

        if (!empty($tableExists)) {
            $columns = $this->emiRepository->getTableColumns('emi_details');
            $data = $this->emiRepository->getEmiData('emi_details');
        }

        return compact('columns', 'data');
    }

    public function processEmiData()
    {
        $minDate = $this->loanRepository->getMinPaymentDate();
        $maxDate = $this->loanRepository->getMaxPaymentDate();

        if (!$minDate || !$maxDate) {
            return false;
        }

        $start = Carbon::parse($minDate)->startOfMonth();
        $end = Carbon::parse($maxDate)->startOfMonth();
        $period = CarbonPeriod::create($start, '1 month', $end);

        $monthCols = [];
        foreach ($period as $month) {
            $monthCols[] = $month->format('Y_M');
        }

        $this->emiRepository->dropTableIfExists('emi_details');
        $this->emiRepository->createEmiTable($monthCols);

        $loans = $this->loanRepository->getAllLoans();

        foreach ($loans as $loan) {
            $emiData = $this->calculateEmiForLoan($loan, $period);
            $this->emiRepository->insertEmiRecord($emiData);
        }

        return true;
    }

    protected function calculateEmiForLoan($loan, $period)
    {
        $emi = round($loan->loan_amount / $loan->num_of_payment, 2);
        $clientStart = Carbon::parse($loan->first_payment_date)->startOfMonth();
        $clientEnd = Carbon::parse($loan->last_payment_date)->startOfMonth();

        $clientPeriod = CarbonPeriod::create($clientStart, '1 month', $clientEnd);
        $emilist = [];

        // Distribute equally
        for ($i = 0; $i < $loan->num_of_payment; $i++) {
            $emilist[$i] = $emi;
        }

        // Adjust final EMI
        $total = array_sum($emilist);
        $diff = round($loan->loan_amount - $total, 2);
        $emilist[count($emilist) - 1] += $diff;

        // Map to columns
        $columns = [];
        $values = [];
        $columns[] = "clientid";
        $values[] = $loan->clientid;
        $i = 0;
        
        foreach ($period as $month) {
            $col = $month->format('Y_M');
            if ($month->between($clientStart, $clientEnd)) {
                $columns[] = "`$col`";
                $values[] = $emilist[$i++];
            } else {
                $columns[] = "`$col`";
                $values[] = 0;
            }
        }

        return ['columns' => $columns, 'values' => $values];
    }
}