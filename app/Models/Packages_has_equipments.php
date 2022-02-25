<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages_has_equipments extends Model
{
    use HasFactory;
    protected $table = 'packages_has_clinic_equipments';
    protected $fillable = ['packages_id', 'clinic_equipments_id', 'user_as_clinic_id'];
    public $timestamps = false;
}
