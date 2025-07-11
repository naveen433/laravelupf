<?php 

namespace App\Repositories\Interfaces;

interface LoanRepositoryInterface
{
    public function getMinPaymentDate();
    public function getMaxPaymentDate();
    public function getAllLoans();
}