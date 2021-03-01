<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public function getStatusAttribute($value)
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ][$value];
    }

}
