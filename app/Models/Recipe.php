<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $table = 'recipes';
    protected $fillable = [
        'user_id',
        'ingredients',
        'steps',
        'cook_time',
        'prep_time',
        'serves',
        'image',
        'video',
        'recomended_age',
        'recipe_name',
        'status'
        
    ];
    function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    function favorite(){
        return $this->hasMany(Favorite::class,'id','recipe_id');
    }
    function rating(){
        return $this->hasMany(Rating::class,'id','recipe_id');
    }
}
