<?php

namespace App\Http\Controllers\Web;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\ChatUser;
use App\Models\User;
use App\Constants\UserTypes;
use App\Repositories\ChatRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Routing\Controller;
use App\Http\Requests;
use Validator;
use Carbon\Carbon;
use Auth;
use App;
use DB;
use Session;
use View;
class ChatsController extends BaseController {


    private $chatRepository;
    private $userRepository;
  
    public function __construct(ChatRepository $chatRepository, UserRepository $userRepository)
    {
        $this->chatRepository = $chatRepository;
        $this->userRepository = $userRepository;
    }


    public function sent_messages(Request $request,$receiver_id = null) {
        $new_receiver = null;
        $chat_id = null;
        $focused_user = null;
        $messages = [];
        $current_uid = auth()->id();
   
        if ($receiver_id != null) {
           
            $chat_chanel = DB::select('SELECT a.id FROM chat a
                                       INNER JOIN chat_users b ON a.id = b.chat_id
                                       WHERE exists ( SELECT 1 FROM chat_users c
                                                      WHERE a.id = c.chat_id
                                                      AND c.user_id = :current_uid )
                                             AND b.user_id = :uid AND type = :type', array(':uid' => $receiver_id, ':current_uid' => $current_uid, ':type' => "private"));
            // print_r($chat_chanel); return;
            // $chat_chanel =$this->chatRepository->chatChanel(request())->get(); 
            if (empty($chat_chanel)) {
                $new_receiver = User::find($receiver_id);
                $focused_user = $new_receiver;
            } else {

                $current_uid = auth()->id();
                $query = "select u.* , zz.chat_id from users u 
                                        JOIN ( SELECT chat_id,user_id FROM chat_users m 
                                               JOIN (SELECT a.id FROM chat a 
                                                     INNER JOIN chat_users b ON a.id = b.chat_id 
                                                     WHERE exists ( SELECT 1 FROM chat_users c 
                                                                    WHERE a.id = c.chat_id AND c.user_id = $current_uid ) AND b.user_id = $current_uid AND type = \"private\") l 
                                               on l.id = m.chat_id WHERE m.user_id <> $current_uid ) zz 
                                       on zz.user_id = u.id where u.id = $receiver_id";

                $_user = DB::select($query);

                $focused_user = $_user[0];
                $messages = ChatMessage::where("chat_id", '=', $focused_user->chat_id)->get();

                $chat_id = $chat_chanel;
            }
        }

$current_uid = auth()->id();
$chat_channels =$this->chatRepository->chatChanels(request(),$current_uid); 
  foreach ($chat_channels as  $value) {
      $latest=ChatMessage::where("chat_id", '=', $value->chat_id)
              ->latest()
              ->first();
            $value->last_message = $latest->message;
            $current = Carbon::now();
            $old = Carbon::parse($latest->created_at);
            $time = $old->diffForHumans($current);
            $value->message_date = $time;

    if($value->image==null){
       $value->image="";
    }
}      

        if ($new_receiver == null and $chat_id == null and count($chat_channels) > 0) {
            $focused_user = $chat_channels[0];
            $messages = ChatMessage::where("chat_id", '=', $focused_user->chat_id)->get();
        }

        request()->query->set('active', 1);
        request()->query->set('type', UserTypes::OWNER);

        $employersCount = $this->userRepository->search(request())->count();

        request()->query->set('type', UserTypes::SEEKER);
        $seekersCount = $this->userRepository->search(request())->count();
        $data = [
            'chat_channels' => $chat_channels,
            "focused_user" => $focused_user,
            "messages" => $messages,
            "new_receiver" => $new_receiver,
            "chat_id" => $chat_id,
            "seekersCount" => $seekersCount,
            "employersCount" => $employersCount,
            
        
            
        ];

  
    return view("web.chat.chats", $data);
       
    }

public function messagesUser() {
        $messages = [];
        $focused_user=User::find(request("user_id"));
        if (\request()->has("chat_id")) {
            $messages = ChatMessage::where("chat_id", '=', \request("chat_id"))->get();
        }
        if (\request()->ajax()) {
            $view = view("web.chat.my_messages_all_messages", compact("messages","focused_user"))->render();
            return response()->json(["status" => true, "result" => $view]);
        }
}

public function addMessage() {

        if (\request()->has("message") && \request("message") != null) {

            if (\request()->has("chat_id")) {

                $chat = Chat::find(\request("chat_id"));
                if (!empty($chat)) {
                    $chatMessage = new ChatMessage();
                    $chatMessage->id = hexdec(uniqid());
                    $chatMessage->chat_id = \request("chat_id");
                    $chatMessage->message = \request("message");
                    $chatMessage->user_id = auth()->id();
                    $chatMessage->save();
           
             
                        $view = view("web.chat.my_messages_sender", ['message' => $chatMessage])->render();
                        return response()->json(['status' => true, "result" => $view]);
                    
                }
            } else if (\request()->has("user_id")) {
                $chat_id = hexdec(uniqid());
                $chat = new Chat();
                $chat->id = $chat_id;
                $chat->creator_id = auth()->id();
                $chat->user_id = \request("user_id");
                $chat->type = "private";
                $chat->save();


                $chatUser = new ChatUser();
                $chatUser->id = hexdec(uniqid());
                $chatUser->chat_id = $chat_id;
                $chatUser->user_id = \request("user_id");
                $chatUser->save();

                $chatUser = new ChatUser();
                $chatUser->id = hexdec(uniqid());
                $chatUser->chat_id = $chat_id;
                $chatUser->user_id = auth()->id();
                $chatUser->save();

                $chatMessage = new ChatMessage();
                $chatMessage->id = hexdec(uniqid());
                $chatMessage->chat_id = $chat_id;
                $chatMessage->message = \request("message");
                $chatMessage->user_id = auth()->id();
                $chatMessage->save();

                $view = view("web.chat.my_messages_sender", ['message' => $chatMessage])->render();
                return response()->json(["status" => true, "isNew" => true, "chat_id" => $chat_id, 'result' => $view]);
            }
        } else {
            return response(['status' => false]);
        }
    }

 
    public function message(Request $request) {

        $rules = [
            'message' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'message' => 'message',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {

            $user_login = auth()->user()->id;
            
            $chat_chanel = DB::select('SELECT a.id FROM chat a
                                       INNER JOIN chat_users b ON a.id = b.chat_id
                                       WHERE exists ( SELECT 1 FROM chat_users c
                                                      WHERE a.id = c.chat_id
                                                      AND c.user_id = :current_uid )
                                             AND b.user_id = :uid AND type = :type', array(':uid' => \request("receiver_id"), ':current_uid' => auth()->id(), ':type' => "private"));

if (!empty(@$chat_chanel)) {
$chatMessage = new ChatMessage();
$chatMessage->id = hexdec(uniqid());
$chatMessage->chat_id = $chat_chanel[0]->id;
$chatMessage->message = \request("message");
if(\request("subject")!=""){
$chatMessage->subject = \request("subject");
}else{
$chatMessage->subject = "";
}

$chatMessage->user_id =$user_login;
$chatMessage->save();


} else {
$chat_id = hexdec(uniqid());
$chat = new Chat();
$chat->id = $chat_id;
$chat->creator_id =$user_login;
$chat->user_id =\request("receiver_id") ;
$chat->type = "private";
$chat->save();


$chatUser = new ChatUser();
$chatUser->id = hexdec(uniqid());
$chatUser->chat_id = $chat_id;
$chatUser->user_id = \request("receiver_id");
$chatUser->save();

$chatUser = new ChatUser();
$chatUser->id = hexdec(uniqid());
$chatUser->chat_id = $chat_id;
$chatUser->user_id = $user_login;
$chatUser->save();

$chatMessage = new ChatMessage();
$chatMessage->id = hexdec(uniqid());
$chatMessage->chat_id = $chat_id;
$chatMessage->message = \request("message");
if(\request("subject")!=""){
$chatMessage->subject = \request("subject");
}else{
$chatMessage->subject = "";
}
$chatMessage->user_id = $user_login;
$chatMessage->save();

}
$data = [
                'msg' => 'success',
            ];

            return response($data, 200)->header('Content-Type', 'text/plain');
        }
    }



}
