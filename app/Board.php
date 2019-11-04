<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    
    protected   $table = "boards",
                $primaryKey = "id",
                $fillable   = ["name", "linke", "msg", "nsfw", "cover"];

    function threads(){
        return $this->hasMany('App\Thread');
    }

    // Users relationship
    public function users(){
        return $this->belongsToMany('App\User', 'board_user', 'board_id', 'user_id');
    }
    
}
