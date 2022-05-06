<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access_token extends Model
{
    use HasFactory;
    protected $table = 'personal_access_tokens';
    protected $fillable = ['tokenable_type ', 'tokenable_id ', 'name', 'token', 'abilities', 'last_used_at'];
    public $timestamps = true;
}
