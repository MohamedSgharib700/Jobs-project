<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = "chat_messages";

    public function user(){
        return $this->belongsTo("App\Models\User","user_id","id");
    }

    public function chat(){
        return $this->belongsTo("App\Models\Chat","chat_id","id");
    }
}
