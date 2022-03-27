<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic_services extends Model
{
    use HasFactory;
    protected $table = 'clinic_services';
    protected $fillable = ['name', 'description', 'min_price', 'max_price', 'user_as_clinic_id'];
    public $timestamps = false;
}
