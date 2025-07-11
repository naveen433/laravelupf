<?php 

namespace App\Repositories;
use App\Repositories\Interfaces\LoanRepositoryInterface;

use App\Models\LoanDetail;

class LoanRepository implements LoanRepositoryInterface
{
    protected $model;

    public function __construct(LoanDetail $model)
    {
        $this->model = $model;
    }

    public function getMinPaymentDate()
    {
        return $this->model->min('first_payment_date');
    }

    public function getMaxPaymentDate()
    {
        return $this->model->max('last_payment_date');
    }

    public function getAllLoans()
    {
        return $this->model->all();
    }
    
}