<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $fillable = ['created_at', 'appointed_at', 'time', 'receipt_orders_id', 'appointment_status_id'];
    public $timestamps = false;

    public function ReceiptOrders()
    {
        return $this->belongsTo(Receipt_orders::class);
    }
}
