<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
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

        // Lấy  giảng viên bằng id
        static function getTeacherByID($teacher_id,$user_id=null){
              $teacher= self::select('teachers.*','class.name as class_name','users.name as user_name','users.email as user_email','users.id as user_id','users.mobile_number as user_mobile','users.profile_pic as user_avatar','users.status as user_status')
        ->join('class','class.id','teachers.class_id')
        ->join('users','users.teacher_id','teachers.id')
        ->where('teachers.id',$teacher_id)
        ->where('users.is_deleted',0);
        if($user_id!=null){
            $teacher= $teacher->where('users.id',$user_id);
        }
       $teacher= $teacher->first();

        return $teacher;
        }
        static function updateTeacher( $request){
            $id = session('id');
            $rulers = [
            'name' =>'required|max:50',
            'id_teacher' =>'required|max:10',
            'date_of_birth' =>'required',
            'address' =>'required|max:100',
            'gender' =>'required|max:50',
            'nation' =>'required|max:50',
            'id_card' =>'required|integer',
            'date_card' =>'required',
            'class_id' =>'required|integer',
            'religion' =>'required|max:50',
            'work_exp' =>'required',
            'position' =>'required',
            'quafilication' =>'required',
            'date_join' =>'required',
            'marital_status' =>'required',
            'email' =>'required|email|unique:users,email,'.$request->user_id,
        ];
        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'email.required' =>'Email bắt buộc phải nhập!!',
            'email.email' =>'Email không đúng định dạng!',
            'email.unique' =>'Email đã tồn tại!!',
            'id_card.integer' =>'Trường này phải là số!!',
            'required' =>'Trường này bắt buộc phải nhập!!',
            'max ' => 'Tối đã :max kí tự!!',
            'min ' => 'Tối thiểu :min kí tự!!',
            'integer' => 'Trường này phải là số !!'
        ];
        $request->validate($rulers,$messages);
        $teacher = teacher::find($id);
        $teacher->id_teacher = $request->id_teacher;
        $teacher->date_of_birth = $request->date_of_birth;
        $teacher->address = $request->address;
        $teacher->gender = $request->gender;
        $teacher->nation = $request->nation;
        $teacher->quafilication = $request->quafilication;
        $teacher->position = $request->position;
        $teacher->work_exp = $request->nation;
        $teacher->id_card = $request->id_card;
        $teacher->date_card = $request->date_card;
        $teacher->date_join = $request->date_join;
        $teacher->marital_status = $request->marital_status;
        $teacher->class_id = $request->class_id;
        $teacher->religion = $request->religion;
        $teacher->save();

        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->user_type = 2;
        $user->teacher_id =$teacher->id;
        $user->status = 0;
        $user->save();
        }
}
