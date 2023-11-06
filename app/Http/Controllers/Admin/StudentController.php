<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ClassModel;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
     public $data =[];

    public function index(){
         $this->data['title'] = 'Danh sách quản trị viên';
         $this->data['students'] = Student::getStudent();
        return view('admin.student.list',$this->data);
    }
    public function create(){
        $this->data['class'] = ClassModel::getClass();
        $this->data['title'] = 'Thêm học sinh';
        return view('admin.student.create',$this->data);
    }
    public function store(Request $request){
        $rulers = [
            'name' =>'required|max:50',
            'email' =>'required|email|unique:users,email,',
            'password' =>'required|max:30|min:6',
            'date_of_birth' =>'required',
            'date_admission' =>'required',
            'id_student' =>'required',
            'native' =>'required|max:100',
            'gender' =>'required|max:50',
            'nation' =>'required|max:50',
            'id_card' =>'required|integer',
            'date_card' =>'required',
            'class_id' =>'required|integer',
            'religion' =>'required|max:50',
            'status' =>'required|integer',
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

        $student = new Student();
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

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile_number = $request->mobile_number;
        $user->user_type = 3;
        $user->student_id =$student->id;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admins.student.list')->with('success','Thêm sinh viên  thành công!');
    }
     public function edit($id){
        session()->put('id', $id);
        $this->data['title'] = 'Chỉnh sửa sinh viên';
        $this->data['class'] = ClassModel::getClass();
        $this->data['student'] = Student::getStudentByID($id);
        return view('admin.student.edit', $this->data);
    }
     public function update(Request $request){
            Student::updateStudent($request);
    return redirect()->back()->with('success','Cập nhật sinh viên thành công!');
    }

    public function delete($id){
         $user = User::find($id);
         $user->is_deleted = 1;
         $user->save();
         return redirect()->route('admins.student.list')->with('success','Xóa sinh viên thành công!');
    }

     public function changeAvatarStudent (Request $request){
        if(empty($request['avatar'])){
                return redirect()->back()->with('danger', 'Đã xảy ra lỗi vui lòng thử lại!!');
            }
      User::changeAvartar($request);
      return redirect()->back()->with('success','Cập nhật ảnh đại diện thành công!!');
    }
}
