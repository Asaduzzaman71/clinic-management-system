<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public function blood()
    {
        return $this->belongsTo(Blood::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getBirthDateAttribute($value)
    {
    
        return Carbon::parse($value)->format('d/m/Y');
    }
    public function getActiveAttribute($value)
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ][$value];
    }

}
