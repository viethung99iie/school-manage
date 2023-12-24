<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Chat extends Model
{
    use HasFactory;
     protected $table = 'chat';

     static function getChat($receiver_id,$sender_id){
        $query = self::select('chat.*')
                    ->where(function($q) use ($receiver_id,$sender_id){

                        $q->where(function($q) use ($receiver_id,$sender_id){
                            $q->where('receiver_id',$sender_id)
                            ->where('sender_id',$receiver_id)
                            ->where('status','>','-1');

                        })->orWhere(function($q) use ($receiver_id,$sender_id){
                            $q->where('receiver_id',$receiver_id)
                            ->where('sender_id',$sender_id);
                        });
                    })
                    ->where('message','!=','')
                    ->orderBy('id','asc')
                    ->get();
                    return $query;
     }

        public function getSender(){
            return $this->belongsTo(User::class,'sender_id');
        }

        public function getReceiver(){
            return $this->belongsTo(User::class,'receiver_id');
        }

        public function userConnect(){
            return $this->belongsTo(User::class,'connect_user_id');
        }

        static function getUser($user_id){
            $userChat = self::select('chat.*',DB::raw('(CASE WHEN chat.sender_id ="'.$user_id.'"THEN chat.receiver_id ELSE chat.sender_id END) AS connect_user_id'))
            ->join('users as sender','sender.id','chat.sender_id')
            ->join('users as receiver','receiver.id','chat.receiver_id');

            if(!empty(Request::get('search'))){
                $search = Request::get('search');
                $userChat = $userChat->where(function($query) use ($search) {

                            $query->where('sender.name','like','%'.$search.'%')
                            ->orWhere('receiver.name','like','%'.$search.'%');
                });
            }
            $userChat = $userChat->WhereIn('chat.id',function($query) use ($user_id){
                $query->selectRaw('max(chat.id)')->from('chat')
                ->where('chat.status','<',2)
                ->where(function($query) use ($user_id){
                    $query->where('chat.sender_id',$user_id)
                        ->orWhere(function($query) use ($user_id){
                            $query->where('chat.receiver_id',$user_id)
                            ->where('chat.status','>',-1);
                        });
                })
                ->groupBy(DB::raw('CASE WHEN chat.sender_id = "'.$user_id.'" THEN chat.receiver_id ELSE chat.sender_id END'));

            })
            ->orderBy('chat.id', 'desc')
            ->get();
                $result = [];
                foreach($userChat as $item){
                    $data = [];
                    $data['id'] = $item->id;
                    $data['message'] = $item->message;
                    $data['created_date'] = $item->created_date;
                    $data['user_id'] = $item->connect_user_id;
                    $data['name'] = $item->userConnect->name;
                    $data['profile_pic'] = $item->userConnect->profile_pic;
                    $data['user_type'] = $item->userConnect->user_type;
                    $data['messageCount'] = $item->CountMessage($item->connect_user_id,$user_id);
                    $result[]= $data;
                }
            return $result;
        }

        static function CountMessage($connect_user_id,$user_id){

            return self::where('sender_id',$connect_user_id)
                        ->where('receiver_id',$user_id)
                        ->where('status',0)->count();
        }
        static function updateCount($receiver_id,$sender_id){
            return self::where('receiver_id',$sender_id)
                        ->where('sender_id',$receiver_id)
                        ->where('status',0)
                        ->update([
                            'status'=> 1,
                        ]);
        }

}