<?php

namespace App\Observers;

use App\Models\Prescription;

class PrescriptionObserver
{



    public function deleting(Prescription $prescription)
    {
        $prescription->DiagnosisReport()->delete();
        
    }
    /**
     * Handle the Prescription "created" event.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return void
     */
    public function created(Prescription $prescription)
    {
        //
    }

    /**
     * Handle the Prescription "updated" event.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return void
     */
    public function updated(Prescription $prescription)
    {
        //
    }

    /**
     * Handle the Prescription "deleted" event.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return void
     */
    public function deleted(Prescription $prescription)
    {
        //
    }

    /**
     * Handle the Prescription "restored" event.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return void
     */
    public function restored(Prescription $prescription)
    {
        //
    }

    /**
     * Handle the Prescription "force deleted" event.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return void
     */
    public function forceDeleted(Prescription $prescription)
    {
        //
    }
}
