<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blood extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
    public function bloodDonors()
    {
        return $this->hasMany(BloodDonor::class);
    }
    public function bloodBank()
    {
        return $this->hasOne(BloodBank::class);
    }
}
