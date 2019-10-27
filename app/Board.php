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

}
