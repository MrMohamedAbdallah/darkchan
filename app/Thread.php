<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected   $table = "threads",
                $primaryKey = "id",
                $fillable   = ["title", "name", "content", "file", "spoiler", 'board_id'];


    // Relationship with board
    function board(){
        return $this->belongsTo('App\Board');
    }


    // Relationship with comments
    function comments(){
        return $this->hasMany('App\Comment');
    }


}
