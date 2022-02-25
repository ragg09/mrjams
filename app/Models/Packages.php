<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;
    protected $table = 'packages';
    protected $fillable = ['name','description','price','user_as_clinic_id'];
    public $timestamps = false;
}
