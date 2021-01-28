<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Prescription extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function getCreatedAtAttribute($value)
    {
    
        return Carbon::parse($value)->format('d/m/Y');
    }
    public function DiagnosisReport()
    {
        return $this->hasMany(DiagnosisReport::class);
    }
    
    

}
