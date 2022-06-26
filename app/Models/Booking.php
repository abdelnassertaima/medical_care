<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function getbookingVisibilityAttribute()
    {
        return $this->booking ? 'active' : 'inactive';
    }

    public function doctor(){
        return $this->belongsTo(Doctor::class , 'doctor_id');
    }

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
