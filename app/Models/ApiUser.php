<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiUser extends Model
{
    use HasFactory;

    protected $table = 'users_api_db';
    
    protected $fillable = ['name', 'email', 'mobileno'];
    
    protected $casts = [
        'id' => 'string'
    ];
}