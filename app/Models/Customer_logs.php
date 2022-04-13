<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_logs extends Model
{
    use HasFactory;
    protected $table = 'customer_logs';
    protected $fillable = ['message','remark','time','date','user_as_customer_id'];
    public $timestamps = false;
}
