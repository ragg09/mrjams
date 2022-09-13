<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic_specialists_compensation extends Model
{
    use HasFactory;
    protected $table = 'clinic_specialists_compensation';
    protected $fillable = ['clinic_specialists_id', 'receipt_order_id', 'compensation', 'claim'];
}
