<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosisReport extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
