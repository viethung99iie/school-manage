<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class FeeCollect extends Model
{
    use HasFactory;
    protected $table = 'fee_collect';


    public static function checkFeeStudent($exam_id,$class_id,$student_id){
        return self::where('student_id',$student_id)
                    ->where('class_id',$class_id)
                    ->where('exam_id',$exam_id)
                    ->where('status',1)
                    ->first();
    }

    public static function getTotalTodate(){
        return self::whereDate('created_at',date('Y-m-d'))
                    ->sum('amount');
    }
     public static function getTotal(){
        return self::
                    sum('amount');
    }
    static function getCollectFeeStudent(){
        $fee =  self::select('fee_collect.*','class.name as class_name','class.amount as class_amount','users.name as user_name','users.email as user_email','users.profile_pic as user_avatar','students.id_student as id_student','exams.name as exam_name')
        ->join('class','class.id','fee_collect.class_id')
        ->join('users','users.student_id','fee_collect.student_id')
        ->join('students','students.id','fee_collect.student_id')
        ->join('exams','exams.id','fee_collect.exam_id');

         if(Request::get('class_id')){
            $fee = $fee->where('fee_collect.class_id',Request::get('class_id'));
        }
        if(Request::get('exam_id')){
            $fee = $fee->where('fee_collect.exam_id',Request::get('exam_id'));
        }
        if(Request::get('id_student')){
            $fee = $fee->where('students.id_student','like','%'.Request::get('id_student').'%');
        }
        if(Request::get('name')){
            $fee = $fee->where('users.name','like','%'.Request::get('name').'%');
        }
        if(Request::get('from_date')){
            $fee = $fee->where('fee_collect.created_at','>=',Request::get('from_date'));
        }
        if(Request::get('to_date')){
            $fee = $fee->where('fee_collect.created_at','<=',Request::get('to_date'));
        }
        $fee = $fee->paginate(50)->withQueryString();;
        return $fee;
        }

}