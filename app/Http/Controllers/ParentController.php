<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use Illuminate\Http\Request;

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

        dd('jeje');


        // $parent = new parent();
        // $parent->id_parent = $request->id_parent;
        // $parent->date_of_birth = $request->date_of_birth;
        // $parent->native = $request->native;
        // $parent->gender = $request->gender;
        // $parent->nation = $request->nation;
        // $parent->id_card = $request->id_card;
        // $parent->date_card = $request->date_card;
        // $parent->date_admission = $request->date_admission;
        // $parent->class_id = $request->class_id;
        // $parent->religion = $request->religion;
        // $parent->save();

        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->user_type = 3;
        // $user->parent_id =$parent->id;
        // $user->status = $request->status;
        // $user->save();

        return redirect()->route('admins.parent.list')->with('success','Thêm sinh viên  thành công!');
    }
    //  public function edit($id){
    //     session()->put('id', $id);
    //     $this->data['title'] = 'Chỉnh sửa sinh viên';
    //     $this->data['class'] = ClassModel::getClass();
    //     $this->data['parent'] = parent::getparentByID($id);
    //     return view('admin.parent.edit', $this->data);
    // }
    //  public function update(Request $request){
    //     $id = session('id');
    //       $rulers = [
    //         'name' =>'required|max:50',
    //         'email' =>'required|email|unique:users,email,'.$id,
    //         'date_of_birth' =>'required',
    //         'date_admission' =>'required',
    //         'id_parent' =>'required',
    //         'native' =>'required|max:100',
    //         'gender' =>'required|max:50',
    //         'nation' =>'required|max:50',
    //         'id_card' =>'required|max:50',
    //         'date_card' =>'required',
    //         'class_id' =>'required|integer',
    //         'religion' =>'required|max:50',
    //         'status' =>'required|integer',
    //     ];
    //     $messages = [
    //         'name.required' =>'Tên bắt buộc phải nhập!!',
    //         'name.min' =>'Tên ít nhất :min kí tự!!',
    //         'email.required' =>'Email bắt buộc phải nhập!!',
    //         'email.email' =>'Email không đúng định dạng!',
    //         'email.unique' =>'Email đã tồn tại!!',
    //         'password.required' =>'Mật khẩu bắt buộc phải nhập!!',
    //         'password.min' =>'Mật khẩu ít nhất :min kí tự!!',
    //         'password.max' =>'Mật khẩu tối đa :max kí tự!!',
    //         'required' =>'Trường này bắt buộc phải nhập!!',
    //         'max ' => 'Tối đã :max kí tự!!',
    //         'min ' => 'Tối thiểu :min kí tự!!',
    //         'integer' => 'Trường này phải là số !!'
    //     ];
    //     $request->validate($rulers,$messages);

    //     $parent = parent::find($id);
    //     $parent->id_parent = $request->id_parent;
    //     $parent->date_of_birth = $request->date_of_birth;
    //     $parent->native = $request->native;
    //     $parent->gender = $request->gender;
    //     $parent->nation = $request->nation;
    //     $parent->id_card = $request->id_card;
    //     $parent->date_card = $request->date_card;
    //     $parent->date_admission = $request->date_admission;
    //     $parent->class_id = $request->class_id;
    //     $parent->religion = $request->religion;
    //     $parent->save();

    //     $user =  User::find(Auth::user()->id);
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     if(!empty($request->password)){
    //         $user->password = Hash::make($request->password);
    //     }
    //     $user->status = $request->status;
    //     $user->save();



    //     return redirect()->route('admins.parent.list')->with('success','Cập nhật sinh viên thành công!');
    // }

    // public function delete($id){
    //      $user = User::find($id);
    //      $user->is_deleted = 1;
    //      $user->save();
    //      return redirect()->route('admins.parent.list')->with('success','Xóa sinh viên thành công!');
    // }
}
