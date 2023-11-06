<?php

namespace App\Http\Controllers\User\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public $data = [];

    public function teacher(){
        $this->data['title'] = 'Thông tin cá nhân';
        $this->data['teacher'] = Teacher::getTeacherByID(Auth::user()->teacher_id,Auth::user()->id);
        return view('teacher.profile.profile',$this->data);
    }

    public function editTeacher($id){
        session()->put('id', $id);
        $this->data['title'] = 'Cập nhật thông tin giảng viên';
        $this->data['class'] = ClassModel::getClass();
        $this->data['teacher'] = Teacher::getTeacherByID($id);
        return view('teacher.profile.edit', $this->data);
    }

    public function updateTeacher(Request $request){
        Teacher::updateTeacher($request);
        return redirect()->back()->with('success','Cập nhật giảng viên thành công!');
    }

    public function changeAvatarTeacher (Request $request){
        if(empty($request['avatar'])){
                return redirect()->back()->with('danger', 'Đã xảy ra lỗi vui lòng thử lại!!');
            }
      User::changeAvartar($request);
      return redirect()->back()->with('success','Cập nhật ảnh đại diện thành công!!');
    }
    public function changePassTeacher(Request $request){
            if(!Auth::check() && Auth::user()->id != $request->user_id ){
                return redirect()->route('login')->with('danger','Đã xảy ra sự có vui lòng đăng nhập lại!!');
            }
            $user = User::find($request->user_id);
            if(!password_verify($request->old_password, $user->password)){
                return redirect()->back()->with('danger','Mật khẩu hiện tại không đúng ');
            }
             if($request->confirm_password != $request->new_password ){
                return redirect()->back()->with('danger','Xác nhận mật khẩu không khớp!!');
            }
            User::changePassword($request);
            return redirect()->back()->with('success','Thay đổi mật khẩu thành công!!');

    }
}