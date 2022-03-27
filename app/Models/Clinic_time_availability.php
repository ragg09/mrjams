<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic_time_availability extends Model
{
    use HasFactory;
    protected $table = 'clinic_time_availability';
    protected $fillable = ['user_as_clinic_id', 'summary'];
    public $timestamps = false;
}
