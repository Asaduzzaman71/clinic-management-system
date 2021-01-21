<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Facility extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
