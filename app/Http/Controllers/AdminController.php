<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    public $data =[];

    public function index(){
         $this->data['title'] = 'Danh sách quản trị viên';
         $this->data['admins'] = User::getAdmin();
        return view('admin.admin.list',$this->data);
    }
    public function create(){
        $this->data['title'] = 'Thêm quản trị viên';
        return view('admin.admin.create',$this->data);
    }
    public function store(Request $request){
        $rulers = [
            'name' =>'required|min:5',
            'email' =>'required|email|unique:users,email,',
            'password' =>'required|min:6'
        ];
        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'email.required' =>'Email bắt buộc phải nhập!!',
            'email.email' =>'Email không đúng định dạng!',
            'email.unique' =>'Email đã tồn tại!!',
            'password.required' =>'Mật khẩu bắt buộc phải nhập!!',
            'password.min' =>'Mật khẩu ít nhất :min kí tự!!',
        ];
        $request->validate($rulers,$messages);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();
        return redirect()->route('admins.admin.list')->with('success','Thêm quản trị viên thành công!');
    }
     public function edit($id){
        session()->put('id', $id);
        $this->data['title'] = 'Thêm quản trị viên';
        $this->data['admin'] = User::find($id);
        return view('admin.admin.edit', $this->data);
    }
     public function update(Request $request){
         $rulers = [
            'name' =>'required|min:5',
            'email' =>'required|email|unique:users,email,',

        ];

        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'email.required' =>'Email bắt buộc phải nhập!!',
            'email.email' =>'Email không đúng định dạng!',
            'email.unique' =>'Email đã tồn tại!!',

        ];
        if($request->password){
            $rulers= [
                'password' =>'required|min:6'
            ];
            $messages= [
                'password.required' =>'Mật khẩu bắt buộc phải nhập!!',
                'password.min' =>'Mật khẩu ít nhất :min kí tự!!',
            ];
        }
        $request->validate($rulers,$messages);

        $id = session('id');
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->updated_at = date('Y-m-d H:i:s');
        $user->save();
        return redirect()->route('admins.admin.list')->with('success','Cập nhật quản trị viên thành công!');
    }

    public function delete($id){
         $user = User::find($id);
         $user->is_deleted = 1;
         $user->save();
         return redirect()->route('admins.admin.list')->with('success','Xóa quản trị viên thành công!');
    }
}
