<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

}
