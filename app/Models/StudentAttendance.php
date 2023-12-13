<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $table = 'student_attendance';

    static function checkAlreadyAttendance($student_id,$class_id,$attendance_date){
        return self::where('student_id',$student_id)->where('class_id',$class_id)->where('attendance_date',$attendance_date)->first();
    }
    static function getAttendance(){
        $return =  self::select('student_attendance.*','class.name as class_name','users.name as student_name','students.id_student as id_student')
                    ->join('class','class.id','student_attendance.class_id')
                    ->join('users','users.student_id','student_attendance.student_id')
                    ->join('students','students.id','student_attendance.student_id')
                    ->orderBy('student_attendance.id','desc');
        if(!empty(Request::get('class_id'))){
            $return = $return->where('student_attendance.class_id',Request::get('class_id'));
        }
        if(!empty(Request::get('attendance'))){
            $return = $return->where('student_attendance.attendance_date',Request::get('attendance'));
        }
        if(!empty(Request::get('name'))){
            $return = $return->where('users.name','like','%'.Request::get('name').'%');
        }
        if(!empty(Request::get('id_student'))){
            $return = $return->where('students.id_student',Request::get('id_student'));
        }
        if(!empty(Request::get('attendance_type'))){
            $return = $return->where('student_attendance.attendance_type',Request::get('attendance_type'));
        }
        $return= $return->paginate(50)->withQueryString();
        return $return;
    }
}