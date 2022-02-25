<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_as_clinic extends Model
{
    use HasFactory;
    protected $table = 'user_as_clinic';
    protected $fillable = ['name','phone','telephone','users_id','clinic_types_id','user_address_id'];
    public $timestamps = false;
}
