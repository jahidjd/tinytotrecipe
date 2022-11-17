<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;
    protected $table = 'forums';
    protected $fillable = [
        'user_id',
        'name',
        'discussion_topic',
    ];
    function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    function post(){
        return $this->hasMany(Post::class,'id','forum_id');
    }
}
