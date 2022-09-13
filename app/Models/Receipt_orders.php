<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt_orders extends Model
{
    use HasFactory;
    protected $table = 'receipt_orders';
    protected $fillable = ['packages_id', 'user_as_clinic_id', 'user_as_customer_id', 'patient_details', 'specialist', 'patient_address'];
    public $timestamps = false;

    public function Appointment()
    {
        return $this->hasOne(Appointments::class);
    }

    public function Appointment_Status()
    {
        return $this->hasOne(Appointment_status::class);
    }
}
