<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment_status extends Model
{
    use HasFactory;
    protected $table = 'appointment_status';
    protected $fillable = ['status', 'remark'];
    public $timestamps = false;


    public function appointment()
    {
        return $this->belongsTo(Receipt_orders::class);
    }
}
