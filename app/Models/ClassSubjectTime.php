<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectTime extends Model
{
    protected $table = 'class_subject_time';


    // lấy tất cả data bằng class_id và subject_id

    static function getTimer($class_id, $subject_id,$week_id=null){
         $timer = self::where('class_id', $class_id)
                    ->where('subject_id', $subject_id);
                if(!empty($week_id)){
                     $timer = $timer->where('week_id', $week_id);
                }
                    $timer = $timer->first();
                return $timer;
    }

}