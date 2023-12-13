<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeBoardMessage extends Model
{
    use HasFactory;
    protected $table = 'notice_board_message';

    public static function checkAlready($notice_board_id,$mess_to){
        return self::where('notice_board_id',$notice_board_id)
                        ->where('mess_to',$mess_to)->first();
    }
    public static function deleteAll($notice_board_id){
        return self::where('notice_board_id',$notice_board_id)
                        ->delete();
    }
}