<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    // public function getStatusAttribute($value)
    // {
    //     return [
    //         1 => 'Active',
    //         0 => 'Inactive',
    //     ][$value];
    // }


}
