<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request as FacadesRequest;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    // Lấy tất cả sinh viên
    static function getTeacher(){
        $teacher =  self::select('teachers.*','class.name as class_name','users.email as user_email','users.name as user_name','users.id as user_id','users.mobile_number as user_mobile','users.profile_pic as user_avatar')
        ->join('class','class.id','teachers.class_id')
        ->join('users','users.teacher_id','teachers.id')
        ->orderBy('users.created_at','desc')
        ->where('users.user_type',2)
        ->where('users.is_deleted',0);
        if(FacadesRequest::get('name')){
            $teacher = $teacher->where('users.name','like','%'.FacadesRequest::get('name').'%');
        }
        if(FacadesRequest::get('email')){
            $teacher = $teacher->where('users.email','like','%'.FacadesRequest::get('email').'%');
        }
        if(FacadesRequest::get('teacher_id')){
            $teacher = $teacher->where('teachers.id_teacher','like','%'.FacadesRequest::get('teacher_id').'%');
        }
        if(FacadesRequest::get('mobile')){
            $teacher = $teacher->where('users.mobile_number','like','%'.FacadesRequest::get('mobile').'%');
        }
        if(FacadesRequest::get('quafilication')){
            $teacher = $teacher->whereDate('teachers.quafilication','like','%'.FacadesRequest::get('quafilication').'%');
        }
        if(FacadesRequest::get('date_join')){
            $teacher = $teacher->whereDate('teachers.date_join','=',FacadesRequest::get('date_join'));
        }
        $teacher = $teacher->paginate(5)->withQueryString();;
        return $teacher;
        }

        // Lấy sinh viên bằng id
        static function getTeacherByID($teacher_id,$user_id=null){
              $teacher= self::select('teachers.*','class.name as class_name','users.name as user_name','users.email as user_email','users.id as user_id','users.mobile_number as user_mobile','users.profile_pic as user_avatar','users.status as user_status')
        ->join('class','class.id','teachers.class_id')
        ->join('users','users.teacher_id','teachers.id')
        ->orderBy('users.created_at','desc')
        ->where('teachers.id',$teacher_id)
        ->where('users.is_deleted',0);
        if($user_id!=null){
            $teacher= $teacher->where('users.id',$user_id);
        }
       $teacher= $teacher->first();

        return $teacher;
        }
}