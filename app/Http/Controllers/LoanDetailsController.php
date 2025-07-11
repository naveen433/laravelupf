<?php
namespace App\Http\Controllers;

use App\Services\LoanService;

class LoanDetailsController extends Controller
{
    protected $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function index()
    {
        $loans = $this->loanService->getAllLoans();
        return view('loan_details.index', compact('loans'));
    }
}
