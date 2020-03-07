<?php

namespace App\Repositories;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\ChatUser;
use Symfony\Component\HttpFoundation\Request;
use DB;
class ChatRepository
{
    public function chatChanels($request,$current_uid)
    {
        $chat_channels=DB::select('select u.id,u.first_name,u.last_name,u.image,u.active as last_message,u.created_at as message_date, zz.chat_id from users u 
                                        JOIN ( SELECT chat_id,user_id FROM chat_users m 
                                               JOIN (SELECT a.id FROM chat a 
                                                     INNER JOIN chat_users b ON a.id = b.chat_id 
                                                     WHERE exists ( SELECT 1 FROM chat_users c 
                                                                    WHERE a.id = c.chat_id AND c.user_id = '.$current_uid.' ) AND b.user_id = '.$current_uid.') l 
                                               on l.id = m.chat_id WHERE m.user_id <> '.$current_uid.' ) zz 
                                       on zz.user_id = u.id');
        
        return $chat_channels;
    }
   
}
