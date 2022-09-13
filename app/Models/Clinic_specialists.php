<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic_specialists extends Model
{
    use HasFactory;
    protected $table = 'clinic_specialists';
    protected $fillable = ['fullname', 'specialization', 'user_as_clinic_id', 'compensation_rate'];
    public $timestamps = false;
}
