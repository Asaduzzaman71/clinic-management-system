<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{  
    use SoftDeletes;
    use HasFactory;
    protected $guarded=[];
 
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }
}
