<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = "chat";

    public function userMessages(){
        return $this->belongsToMany("App\Models\User","chat_messages","chat_id","user_id")
                    ->withPivot("message")
                    ->withTimestamps();
    }

    public function messages(){
        return $this->hasMany("App\Models\ChatMessage","chat_id",'id');
    }

    public function chatUsers() {
        return $this->hasMany("App\Models\ChatUser","chat_id","id");
    }
}
