<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    protected   $table = 'comments',
                $primaryKey = 'id',
                $fillable   = [
                    'name', 'conent', 'file', 'password'
                ];

    // Relationship with thread
    function thread(){
        return $this->belongsTo("App\Thread");
    }
                
}
