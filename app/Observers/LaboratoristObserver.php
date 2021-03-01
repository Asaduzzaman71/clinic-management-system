<?php

namespace App\Observers;

use App\Models\Laboratorist;

class LaboratoristObserver
{
    public function deleting(Laboratorist $laboratorist)
    {
        
        $laboratorist->user()->forcedelete();
        //$patient->prescriptions()->DiagnosisReport()->forcedelete();
        // $patient->prescriptions()->delete();
        // $patient->appointments()->delete();
       
    }
    public function created(Laboratorist $laboratorist)
    {
        //
    }

    /**
     * Handle the Laboratorist "updated" event.
     *
     * @param  \App\Models\Laboratorist  $laboratorist
     * @return void
     */
    public function updated(Laboratorist $laboratorist)
    {
        //
    }

    /**
     * Handle the Laboratorist "deleted" event.
     *
     * @param  \App\Models\Laboratorist  $laboratorist
     * @return void
     */
    public function deleted(Laboratorist $laboratorist)
    {
        //
    }

    /**
     * Handle the Laboratorist "restored" event.
     *
     * @param  \App\Models\Laboratorist  $laboratorist
     * @return void
     */
    public function restored(Laboratorist $laboratorist)
    {
        //
    }

    /**
     * Handle the Laboratorist "force deleted" event.
     *
     * @param  \App\Models\Laboratorist  $laboratorist
     * @return void
     */
    public function forceDeleted(Laboratorist $laboratorist)
    {
        //
    }
}
