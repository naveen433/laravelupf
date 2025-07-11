<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\LoanRepositoryInterface;
use App\Repositories\LoanRepository;
use App\Repositories\Interfaces\EmiRepositoryInterface;
use App\Repositories\EmiRepository;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            LoanRepositoryInterface::class,
            LoanRepository::class
        );

        $this->app->bind(
            EmiRepositoryInterface::class,
            EmiRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        
    }
}
