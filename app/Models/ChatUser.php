<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    protected $table = "chat_users" ;

    public function user(){
        return $this->belongsTo("App\Models\User","user_id","id");
    }

    public function chat(){
        return $this->belongsTo("App\Models\Chat","chat_id","id");
    }
}
