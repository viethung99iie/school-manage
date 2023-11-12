<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
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
            // Lấy sinh viên bằng id
        static function getStudentByID($student_id,$user_id=null){
            $student= self::select('students.*','class.name as class_name','users.name as user_name','users.email as user_email','users.id as user_id','users.mobile_number as user_mobile','users.profile_pic as user_avatar','users.status as user_status')
            ->join('class','class.id','students.class_id')
            ->join('users','users.student_id','students.id')
            ->where('students.id',$student_id)
            ->where('users.is_deleted',0);
            if($user_id!=null){
                $student= $student->where('users.id',$user_id);
            }
            $student= $student->first();
            return $student;
        }

        // tìm kiếm sinh viên của theo
        static function searchMyStudent($id){
        if(FacadesRequest::get('name') && FacadesRequest::get('email') && FacadesRequest::get('id_student') && FacadesRequest::get('date_of_birth')){
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
        $student = $student->paginate(3)->withQueryString();;
        return $student;

        }

        static function updateStudent($request){
            $id = session('id');
          $rulers = [
            'name' =>'required|max:50',
            'email' =>'required|email|unique:users,email,'.$request->user_id,
            'date_of_birth' =>'required',
            'date_admission' =>'required',
            'id_student' =>'required|max:10',
            'native' =>'required|max:100',
            'gender' =>'required|max:50',
            'nation' =>'required|max:50',
            'id_card' =>'required|max:50',
            'date_card' =>'required',
            'class_id' =>'required|integer',
        ];
        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'email.required' =>'Email bắt buộc phải nhập!!',
            'email.email' =>'Email không đúng định dạng!',
            'email.unique' =>'Email đã tồn tại!!',
            'required' =>'Trường này bắt buộc phải nhập!!',
            'max ' => 'Tối đã :max kí tự!!',
            'min ' => 'Tối thiểu :min kí tự!!',
            'integer' => 'Trường này phải là số !!'
        ];
        $request->validate($rulers,$messages);
        $student = Student::find($id);
        $student->id_student = $request->id_student;
        $student->date_of_birth = $request->date_of_birth;
        $student->native = $request->native;
        $student->gender = $request->gender;
        $student->nation = $request->nation;
        $student->id_card = $request->id_card;
        $student->date_card = $request->date_card;
        $student->date_admission = $request->date_admission;
        $student->class_id = $request->class_id;
        $student->religion = $request->religion;
        $student->save();

        $user =  User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->status = 0;
        $user->save();
        }

        // danh sách sinh viên trong lớp

        static function getStudentInClass($class_id){
             return self::select('students.*','users.name as user_name','users.email as user_email','users.id as user_id', 'class.name as class_name')
        ->join('class','class.id','students.class_id')
        ->join('users','users.student_id','students.id')
        ->orderBy('users.created_at','desc')
        ->where('students.class_id',$class_id)
        ->where('users.is_deleted',0)
        ->paginate(8)->withQueryString();
        }

}