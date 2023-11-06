<?php

namespace App\Http\Controllers\User\parent;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ParentModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public $data = [];

    public function index(){
        $this->data['title'] = 'Thông tin cá nhân';
        $this->data['parent'] = ParentModel::getParentByID(Auth::user()->parent_id,Auth::user()->id);
        return view('parent.profile.profile',$this->data);
    }

    public function edit($id){
        session()->put('id', $id);
        $this->data['title'] = 'Cập nhật thông tin phụ huynh';
        $this->data['parent'] = ParentModel::getParentByID($id);
        return view('parent.profile.edit', $this->data);
    }

    public function update(Request $request){
        ParentModel::updateParent($request);
        return redirect()->back()->with('success','Cập nhật phụ huynh thành công!');
    }

    public function changeAvatar (Request $request){
        if(empty($request['avatar'])){
                return redirect()->back()->with('danger', 'Đã xảy ra lỗi vui lòng thử lại!!');
            }
      User::changeAvartar($request);
      return redirect()->back()->with('success','Cập nhật ảnh đại diện thành công!!');
    }
    public function changePass(Request $request){
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