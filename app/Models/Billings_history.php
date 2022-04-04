<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billings_history extends Model
{
    use HasFactory;
    protected $table = 'billings_history';
    protected $fillable = [
        'paid',
        'comment',
        'created_at',
        'updated_at',
        'billings_id',
    ];
    public $timestamps = true;
}
