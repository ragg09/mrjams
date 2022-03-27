<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt_orders_has_clinic_services extends Model
{
    use HasFactory;
    protected $table = 'receipt_orders_has_clinic_services';
    protected $fillable = ['receipt_orders_id', 'clinic_services_id'];
    public $timestamps = false;
}
