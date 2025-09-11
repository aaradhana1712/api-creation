<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicCategory extends Model
{
    //
    use HasFactory;
    protected $table = 'music_categories'; // add
    
    protected $fillable = ['music_category'];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
