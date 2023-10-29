<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public $data = [];
    public function teacher(){
        $this->data['title'] = ['Thông tin cá nhân'];
        $this->data['teacher'] = Teacher::getTeacherByID(Auth::user()->teacher_id,Auth::user()->id);
        return view('teacher/profile',$this->data);
    }
    public function changeAvatar (Request $request){
        if($request['avatar']){
            if($request->old_avatar!=null){
                Storage::disk('public')->delete($request->old_avatar);
            }
            $image = $request->file('avatar');
            $name = time().'_' . $image->getClientOriginalName();
            Storage::disk('public')->put($name,FacadesFile::get($image));
            $imageProduct = $name;
        }else{
                $imageProduct = 'default.png';
        }
        $user = User::find($request->user_id);
        $user->profile_pic = $imageProduct;
        $user->save();
        return redirect()->back()->with('success','Cập nhật ảnh đại diện thành công!!');
    }
}