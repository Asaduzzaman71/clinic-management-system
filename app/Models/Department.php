<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    
    protected $guarded=[];


    public function facilities()
    {
        return $this->hasMany(Post::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
    public function getStatusAttribute($value)
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ][$value];
    }

}
