<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic_equipments extends Model
{
    use HasFactory;
    protected $table = 'clinic_equipments';
    protected $fillable = ['name', 'quantity', 'unit', 'user_as_clinic_id'];
    public $timestamps = false;
}
