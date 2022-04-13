<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic_equipment_inventory extends Model
{
    use HasFactory;
    protected $table = 'equipment_inventory';
    protected $fillable = ['acquired', 'expiration', 'qunaity', 'supplier', 'clinic_equipments_id'];
    public $timestamps = false;
}
