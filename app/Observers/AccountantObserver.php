<?php

namespace App\Observers;

use App\Models\Accountant;

class AccountantObserver
{
    public function deleting(Accountant $accountant)
    {
        $accountant->user()->forcedelete();
    
    }
    public function created(Accountant $accountant)
    {
        
    
    }

    /**
     * Handle the Accountant "updated" event.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return void
     */
    public function updated(Accountant $accountant)
    {
        //
    }

    /**
     * Handle the Accountant "deleted" event.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return void
     */
    public function deleted(Accountant $accountant)
    {
        //
    }

    /**
     * Handle the Accountant "restored" event.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return void
     */
    public function restored(Accountant $accountant)
    {
        //
    }

    /**
     * Handle the Accountant "force deleted" event.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return void
     */
    public function forceDeleted(Accountant $accountant)
    {
        //
    }
}
