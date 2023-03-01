<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = false;

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }  
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }        
    public function category()
    {
        return $this->belongsTo(Category::class);
    } 
    
    public function getImageUrlAttribute()
    {
        return url('storage/' . $this->preview_image);
    }
}
