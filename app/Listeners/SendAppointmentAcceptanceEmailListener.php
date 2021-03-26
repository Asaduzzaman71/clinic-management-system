<?php

namespace App\Listeners;
use App\Mail\SendAppointmentAcceptanceEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Day;


class SendAppointmentAcceptanceEmailListener implements ShouldQueue
{
   
 
    public function handle($event)
    {

        sleep(60);
        $date=$event->appointment->date;
        
       
         //fetch day name from the date
         $dayName=Carbon::createFromFormat('d/m/Y', $date)->format('l');
         //dd($day);
         $day=Day::where('day_name',$dayName)->first();
         //dd($dayId);
         $schedule=Schedule::Where(['doctor_id' => $event->appointment->doctor_id, 'day_id' => $day->id])->first();
         //dd($schedule);

        $data=[
            'patientName'=>$event->appointment->name,
            'doctorName'=>$event->appointment->doctor->name,
            'date'=>$date,
            'day'=>$dayName,
            'startingTime'=>$schedule->starting_time,
            'endingTime'=>$schedule->ending_time,
            
        ];
        Mail::to($event->appointment->email)->send(new SendAppointmentAcceptanceEmail($data));
    }
}
