<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic_auto_scheduling extends Model
{
    use HasFactory;
    protected $table = 'clinic_auto_scheduling';
    protected $fillable = ['auto_fill_date', 'auto_accept', 'summary', 'user_as_clinic_id'];
    public $timestamps = false;
}
