<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billings extends Model
{
    use HasFactory;
    protected $table = 'billings';
    protected $fillable = [
        'total_paid',
        'balance',
        'price_summary',
        'receipt_orders_id',
        'user_as_clinic_id',
        'user_as_customer_id',
        'billing_status_id',
        'updated_at',
        'created_at',
    ];
    public $timestamps = true;
}
