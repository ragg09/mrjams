<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $fillable = ['rating', 'comment', 'users_id_rater', 'users_id_ratee'];
    public $timestamps = false;
}
