<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public $data =[];

    public function index(){
         $this->data['title'] = 'Danh sách lớp học';
         $this->data['class'] = ClassModel::getRecord();
        return view('admin.class.list',$this->data);
    }
    public function create(){
        $this->data['title'] = 'Thêm quản trị viên';
        return view('admin.class.create');
    }
    public function store(Request $request){
        $rulers = [
            'name' =>'required|min:2',
            'status' =>'required|integer'
        ];
        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'status.required' =>'Trạng thái bắt buộc phải chọn!!',
            'status.integer' =>'Đừng sửa bậy!!',
        ];
        $request->validate($rulers,$messages);

        $class = new ClassModel();
        $class->name = $request->name;
        $class->status = $request->status;
        $class->created_by = 1;
        $class->save();
        return redirect()->route('admins.class.list')->with('success','Thêm lớp thành công!');
    }
     public function edit($id){
        session()->put('id', $id);
        $this->data['title'] = 'Chỉnh sửa lớp học';
        $this->data['class'] = ClassModel::find($id);
        return view('admin.class.edit', $this->data);
    }
     public function update(Request $request){
        $id = session('id');
        $rulers = [
            'name' =>'required|min:2',
            'status' =>'required|integer'
        ];
        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'status.required' =>'Trạng thái bắt buộc phải chọn!!',
            'status.integer' =>'Đừng sửa bậy!!',
        ];
        $request->validate($rulers,$messages);

        $class = ClassModel::find($id);
        $class->name = $request->name;
        $class->status = $request->status;
        $class->created_by = 1;
        $class->save();
        return redirect()->route('admins.class.list')->with('success','Cập nhật lớp thành công!');
    }
       public function delete($id){
         $class = ClassModel::find($id)->delete();
         if($class){
              return redirect()->route('admins.class.list')->with('success','Xóa lớp thành công!');
         }
           return redirect()->route('admins.class.list')->with('danger','Vui lòng thao tác lại!');

}
}
