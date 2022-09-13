<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic_vaults extends Model
{
    use HasFactory;
    protected $table = 'clinic_vault';
    protected $fillable = ['user_as_clinic_id', 'password'];
    public $timestamps = false;
}
