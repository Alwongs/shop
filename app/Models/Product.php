<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Filterable;

class Product extends Model
{

    use Filterable;

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
    public function group()
    {
        return $this->belongsTo(Group::class);
    } 
    public function productImages()
    {
        return $this->hasMany(productImage::class);
    } 

    
    public function getImageUrlAttribute()
    {
        return url('storage/' . $this->preview_image);
    }
}
