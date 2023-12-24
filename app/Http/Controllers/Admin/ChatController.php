<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public $data = [];

    public function chat(Request $request){
        $this->data['title'] = 'Tin nhắn của tôi';
         $this->data['receiver_id'] = '';
        if(!empty($request->receiver_id)){
            $receiver_id = $request->receiver_id;
            if($request->user_type==2){
                $receiver = User::findTeacher($receiver_id);
                $sender = Auth::user()->teacher_id;
            }elseif($request->user_type==3){
                $receiver = User::findStudent($receiver_id);
                $sender = Auth::user()->student_id;
            }elseif($request->user_type==4){
                $receiver = User::findParent($receiver_id);
                $sender = Auth::user()->parent_id;
            }else{
                $receiver = User::find($receiver_id);
                $sender = Auth::user()->id;
            }
            $this->data['receiver'] = $receiver;
            Chat::updateCount($receiver->id,Auth::user()->id);
            $this->data['getChat']= Chat::getChat($receiver->id,Auth::user()->id);

            if($receiver_id == $sender){
                return redirect()->back()->with('danger', 'Bạn không thể nhắn với chính bạn');
                exit();
            }
             $this->data['receiver_id'] = $receiver->id;
        }
        $this->data['getUser']= Chat::getUser(Auth::user()->id);
        return view('chat.list',$this->data);
    }


    public function submit(Request $request){
        $chat = new Chat();
        $chat->receiver_id = $request->receiver_id;
        $chat->sender_id = Auth::user()->id;
        $chat->message = $request->message;
        $chat->created_date = time();
        $chat->save();
        $getChat= Chat::where('id',$chat->id)->get();
        return response()->json([
            'status' => true,
            'success' => view('chat._single',
            [
                "getChat" => $getChat,
            ]
            )->render(),
        ],200);
    }

    public function get_chat_window(Request $request){
        if(!empty($request->receiver_id)){
            $receiver_id =$request->receiver_id;
            $receiver = User::find($receiver_id);
            Chat::updateCount($receiver_id,Auth::user()->id);
            $getChat= Chat::getChat($receiver_id,Auth::user()->id);
            return response()->json([
            'status' => true,
            'user_type' => $request->user_type,
            'receiver_id' => $request->receiver_id,
            'success' => view('chat._message',
            [
                "getChat" => $getChat,
                'receiver' => $receiver
            ]
            )->render(),
        ],200);
        }
    }
    public function get_chat_search_user(Request $request){
        $receiver_id =$request->receiver_id;
        $getUser= Chat::getUser(Auth::user()->id);
        return response()->json([
            'status' => true,
            'success' => view('chat._user',
            [
                "getUser" => $getUser,
                'receiver_id' => $receiver_id
            ]
            )->render(),
        ],200);
    }

}