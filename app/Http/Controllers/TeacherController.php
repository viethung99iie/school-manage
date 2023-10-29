<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public $data =[];
    public function index(){
         $this->data['title'] = 'Danh sách giảng viên';
         $this->data['teachers'] = Teacher::getTeacher();
        return view('admin.teacher.list',$this->data);
    }
    public function create(){
        $this->data['class'] = ClassModel::getClass();
        $this->data['title'] = 'Thêm Giảng Viên';
        return view('admin.teacher.create',$this->data);
    }
     public function store(Request $request){
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
            'email' =>'required|email|unique:users,email,',
            'password' =>'required|max:30|min:6',
        ];
        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'email.required' =>'Email bắt buộc phải nhập!!',
            'email.email' =>'Email không đúng định dạng!',
            'email.unique' =>'Email đã tồn tại!!',
            'password.required' =>'Mật khẩu bắt buộc phải nhập!!',
            'password.min' =>'Mật khẩu ít nhất :min kí tự!!',
            'password.max' =>'Mật khẩu tối đa :max kí tự!!',
            'id_card.integer' =>'Trường này phải là số!!',
            'required' =>'Trường này bắt buộc phải nhập!!',
            'max ' => 'Tối đã :max kí tự!!',
            'min ' => 'Tối thiểu :min kí tự!!',
            'integer' => 'Trường này phải là số !!'
        ];
        $request->validate($rulers,$messages);
        $teacher = new teacher();
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

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->password = Hash::make($request->password);
        $user->user_type = 2;
        $user->teacher_id =$teacher->id;
        $user->status = 0;
        $user->save();

        return redirect()->route('admins.teacher.list')->with('success','Thêm giảng viên thành công!');
    }
     public function edit($id){
        session()->put('id', $id);
        $this->data['title'] = 'Cập nhật thông tin giảng viên';
        $this->data['class'] = ClassModel::getClass();
        $this->data['teacher'] = Teacher::getTeacherByID($id);
        return view('admin.teacher.edit', $this->data);
    }
     public function update(Request $request){
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
        $user->password = Hash::make($request->password);
        $user->user_type = 2;
        $user->teacher_id =$teacher->id;
        $user->status = 0;
        $user->save();
        return redirect()->route('admins.teacher.list')->with('success','Cập nhật giảng viên thành công!');
    }
         public function delete($id){
         $user = User::find($id);
         $user->is_deleted = 1;
         $user->save();
         return redirect()->route('admins.teacher.list')->with('success','Xóa giảng viên thành công!');
         }
}
