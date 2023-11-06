<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ParentModel;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
     public $data =[];

    public function index(){
         $this->data['title'] = 'Danh sách phụ huynh';
         $this->data['parents'] = ParentModel::getParent();
        return view('admin.parent.list',$this->data);
    }
    public function create(){
        $this->data['title'] = 'Thêm phụ huynh';
        return view('admin.parent.create',$this->data);
    }
    public function store(Request $request){
        $rulers = [
            'name' =>'required|max:50',
            'email' =>'required|email|unique:users,email,',
            'password' =>'required|max:30|min:6',
            'date_of_birth' =>'required',
            'address' =>'required',
            'occupation' =>'required|max:50',
            'gender' =>'required|max:50',
            'id_card' =>'required|integer',
            'date_card' =>'required',
            'nation' =>'required|max:50',
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
        $parent = new parentModel();
        $parent->date_of_birth = $request->date_of_birth;
        $parent->address = $request->address;
        $parent->occupation = $request->occupation;
        $parent->gender = $request->gender;
        $parent->id_card = $request->id_card;
        $parent->date_card = $request->date_card;
        $parent->nation = $request->nation;
        $parent->save();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 4;
        $user->parent_id =$parent->id;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admins.parent.list')->with('success','Thêm phụ huynh  thành công!');
    }
     public function edit($id){
        session()->put('id', $id);
        $this->data['title'] = 'Chỉnh sửa thông tin phụ huynh';
        $this->data['parent'] = parentModel::getParentByID($id);
        return view('admin.parent.edit', $this->data);
    }
     public function update(Request $request){
        ParentModel::update($request);
        return redirect()->route('admins.parent.list')->with('success','Cập nhật phụ huynh thành công!');
    }
    public function delete($id){
         $user = User::find($id);
         $user->is_deleted = 1;
         $user->save();
         return redirect()->route('admins.parent.list')->with('success','Xóa phụ huynh thành công!');
    }
    public function myStudent($id){
            $this->data['title'] = 'Phụ huynh và sinh viên';
            $this->data['search_student'] = Student::searchMyStudent($id);
            $this->data['parent_id'] = $id;
            $this->data['my_students'] = Student::getMyStudentByID($id);
        return view('admin.parent.my_student',$this->data);
    }
    public function notMyStudent($id){
        $student = Student::find($id);
         $student->parent_id = 0;
         $student->save();
         return redirect()->back()->with('success','Cập nhật thành công!');
    }
    public function assignStudent($parent_id , $student_id){
        $student = Student::find($student_id);
         $student->parent_id = $parent_id;
         $student->save();
         return redirect()->back()->withInput()->with('success','Cập nhật thành công!');
    }
}
