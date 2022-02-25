<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_as_customer extends Model
{
    use HasFactory;
    protected $table = 'user_as_customer';
    protected $fillable = ['fname', 'mname', 'lname', 'gender', 'phone', 'age', 'users_id', 'user_address_id'];
    public $timestamps = false;
}
