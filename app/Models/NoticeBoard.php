<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class NoticeBoard extends Model
{
    use HasFactory;
    protected $table = 'notice_board';

    public static function getNotice(){
        $notice=  self::join('users','users.id','notice_board.create_by')
                    ->select('notice_board.*','users.name as create_by')
                    ->orderBy('notice_board.id','desc');
        if(Request::get('title')){
            $notice = $notice->where('notice_board.title','like','%'.Request::get('title').'%');
        }
        if(Request::get('notice_date')){
            $notice = $notice->whereDate('notice_board.notice_date','=',Request::get('notice_date'));
        }
        if(Request::get('publish_date')){
            $notice = $notice->whereDate('notice_board.publish_date','=',Request::get('publish_date'));
        }
        if(Request::get('messto')){
            $notice = $notice->join('notice_board_message','notice_board_message.notice_board_id','notice_board.id')
                            ->where('notice_board_message.mess_to','=',Request::get('messto'));
        }
        $notice= $notice->paginate(20)->withQueryString();

        return $notice;
    }

    public function getMessage(){
        return $this->hasMany(NoticeBoardMessage::class,'notice_board_id');
    }
    public function checkAlreadyExists($notice_board_id,$mess_to){
        return NoticeBoardMessage::checkAlready($notice_board_id,$mess_to);
    }

     public static function getNoticeUser($user_type){
        $notice=  self::join('users','users.id','notice_board.create_by')
                    ->select('notice_board.*','users.name as create_by')
                    ->orderBy('notice_board.publish_date','desc')
                    ->join('notice_board_message','notice_board_message.notice_board_id','notice_board.id')
                    ->where('notice_board_message.mess_to',$user_type);
        if(Request::get('from_date')){
            $notice = $notice->whereDate('notice_board.publish_date','>=',Request::get('from_date'));
        }
        if(Request::get('to_date')){
            $notice = $notice->whereDate('notice_board.publish_date','<=',Request::get('to_date'));
        }
        $notice= $notice->paginate(2)->withQueryString();

        return $notice;
     }
}