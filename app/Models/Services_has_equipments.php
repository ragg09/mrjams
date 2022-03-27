<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services_has_equipments extends Model
{
    use HasFactory;
    protected $table = 'clinic_services_has_equipments';
    protected $fillable = ['clinic_services_id', 'clinic_equipments_id', 'user_as_clinic_id'];
    public $timestamps = false;
}
