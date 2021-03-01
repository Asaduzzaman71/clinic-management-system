<?php

namespace App\Providers;
use App\Models\Department;
use App\Models\Doctor;
use App\Observers\DoctorObserver;
use App\Models\Patient;
use App\Observers\PatientObserver;
use App\Models\Prescription;
use App\Observers\PrescriptionObserver;
use App\Models\Laboratorist;
use App\Observers\LaboratoristObserver;
use App\Models\Accountant;
use App\Observers\AccountantObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {  
        Doctor::observe(DoctorObserver::class); 
        Patient::observe(PatientObserver::class);
        Prescription::observe(PrescriptionObserver::class);
        Laboratorist::observe(LaboratoristObserver::class);
        Accountant::observe(AccountantObserver::class);


        
        Paginator::useBootstrap();
        $departments= Department::pluck('name', 'id');
        view()->share('departments',$departments);
      
    }
}
