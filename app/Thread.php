<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected   $table = "threads",
                $primaryKey = "id",
                $fillable   = ["title", "name", "content", "file", "spoiler"];

    function board(){
        return $this->belongsTo('App\Board');
    }
}
