<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicSubCategory extends Model

{
    use HasFactory;

    protected $table = 'music_sub_category';
    
    protected $fillable = [
        'name',
        'image',
        'music_category_id'
    ];

    // Relationship with MusicCategory
    public function musicCategory()
    {
        return $this->belongsTo(MusicCategory::class, 'music_category_id');
    }
}