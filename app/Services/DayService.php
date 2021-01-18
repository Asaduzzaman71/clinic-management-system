<?php
namespace App\Services;
use App\Models\Day;

class DayService{

    public function getDropdownList()
    {
        return Day::pluck('day_name', 'id');
    }
    

}