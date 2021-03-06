<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getStatusAttribute($value)
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ][$value];
    }


}
