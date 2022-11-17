<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $fillable = [
        'user_id',
        'recipe_id',
        'remarks'
    ];
    function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    function recipe(){
        return $this->belongsTo(Recipe::class,'recipe_id','id');
    }
}
