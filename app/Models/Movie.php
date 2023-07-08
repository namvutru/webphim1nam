<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps=false;
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function movie_genre(){
        return $this->hasMany(Movie_Genre::class);
    }
    public function episode(){
        return $this->hasMany(Episode::class);
    }
}
