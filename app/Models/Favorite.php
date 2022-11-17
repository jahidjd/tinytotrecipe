<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorites';
    protected $fillable = [
        'user_id',
        'recipe_id'
    ];
    function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    function recipe(){
        return $this->belongsTo(Recipe::class,'recipe_id','id');
    }
}
