<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'forum_id',
        'post'
    ];
    function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    function forum(){
        return $this->belongsTo(Forum::class,'forum_id','id');
    }
}
