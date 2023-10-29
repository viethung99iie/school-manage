<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request as FacadesRequest;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    // Lấy tất cả sinh viên
    static function getStudent(){
        $student =  self::select('students.*','class.name as class_name','users.email as user_email','users.name as user_name','users.id as user_id','users.profile_pic as user_avatar')
        ->join('class','class.id','students.class_id')
        ->join('users','users.student_id','students.id')
        ->orderBy('users.created_at','desc')
        ->where('users.user_type',3)
        ->where('users.is_deleted',0);
        if(FacadesRequest::get('name')){
            $student = $student->where('users.name','like','%'.FacadesRequest::get('name').'%');
        }
        if(FacadesRequest::get('email')){
            $student = $student->where('users.email','like','%'.FacadesRequest::get('email').'%');
        }
        if(FacadesRequest::get('student_id')){
            $student = $student->where('students.id_student','like','%'.FacadesRequest::get('student_id').'%');
        }
        if(FacadesRequest::get('class')){
            $student = $student->where('class.name','like','%'.FacadesRequest::get('class').'%');
        }
        if(FacadesRequest::get('date_of_birth')){
            $student = $student->whereDate('students.date_of_birth','=',FacadesRequest::get('date_of_birth'));
        }
        if(FacadesRequest::get('date_admission')){
            $student = $student->whereDate('students.date_admission','=',FacadesRequest::get('date_admission'));
        }
        $student = $student->paginate(5)->withQueryString();;
        return $student;
        }

        // Lấy sinh viên bằng id
        static function getStudentByID($id){
             return self::select('students.*','class.name as class_name','users.name as user_name','users.email as user_email','users.id as user_id','users.mobile_number as user_mobile','users.profile_pic as user_avatar','users.status as user_status')
        ->join('class','class.id','students.class_id')
        ->join('users','users.student_id','students.id')
        ->orderBy('users.created_at','desc')
        ->where('students.id',$id)
        ->where('users.is_deleted',0)
        ->first();
        }
        // Tìm sinh viên bằng id của phụ huynh
        static function getMyStudentByID($id){
             return self::select('students.*','class.name as class_name','users.name as user_name','users.email as user_email','users.id as user_id')
        ->join('class','class.id','students.class_id')
        ->join('users','users.student_id','students.id')
        ->join('parents','parents.id','students.parent_id')
        ->orderBy('users.created_at','desc')
        ->where('students.parent_id',$id)
        ->where('users.is_deleted',0)
        ->get();
        }

        // tìm kiếm sinh viên của theo
        static function searchMyStudent($id){
        if(empty(FacadesRequest::get('name') || FacadesRequest::get('email') || FacadesRequest::get('id_student') || FacadesRequest::get('date_of_birth'))){
            return;
        }
        $student =  self::select('students.*','class.name as class_name','users.email as user_email','users.name as user_name','users.id as user_id')
        ->join('class','class.id','students.class_id')
        ->join('users','users.student_id','students.id')
        ->orderBy('users.created_at','desc')
        ->where('users.user_type',3)
        ->Where('students.parent_id',"!=",$id)
        ->Where('students.parent_id',0)
        ->where('users.is_deleted',0);
        if(FacadesRequest::get('name')){
            $student = $student->where('users.name','like','%'.FacadesRequest::get('name').'%');
        }
        if(FacadesRequest::get('email')){
            $student = $student->where('users.email','like','%'.FacadesRequest::get('email').'%');
        }
        if(FacadesRequest::get('id_student')){
            $student = $student->where('students.id_student','like','%'.FacadesRequest::get('id_student').'%');
        }
        if(FacadesRequest::get('date_of_birth')){
            $student = $student->whereDate('students.date_of_birth','=',FacadesRequest::get('date_of_birth'));
        }
        $student = $student->paginate(5)->withQueryString();;
        return $student;
        }
}