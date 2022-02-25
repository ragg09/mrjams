<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    protected $table = 'logs';
    protected $fillable = ['message','remark','time','date','user_as_clinic_id'];
    public $timestamps = false;
}
