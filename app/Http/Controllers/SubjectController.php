<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
      public $data =[];

    public function index(){
         $this->data['title'] = 'Danh sách môn học';
         $this->data['subjects'] = Subject::getRecord();
        return view('admin.subject.list',$this->data);
    }
    public function create(){
        $this->data['title'] = 'Thêm môn học';
        return view('admin.subject.create');
    }
    public function store(Request $request){
        $rulers = [
            'name' =>'required|min:2',
            'type' =>'required|string',
            'status' =>'required|integer'
        ];
        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'type.required' =>'Thể loại bắt buộc phải chọn!!',
            'type.string' =>'Bắt buộc phải chọn',
            'status.required' =>'Trạng thái bắt buộc phải chọn!!',
            'status.integer' =>'Đừng sửa bậy!!',
        ];
        $request->validate($rulers,$messages);

        $subject = new Subject();
        $subject->name = $request->name;
        $subject->type = $request->type;
        $subject->status = $request->status;
        $subject->created_by = 1;
        $subject->created_at = date('Y:m:d H:i:s');
        $subject->save();
        return redirect()->route('admins.subject.list')->with('success','Thêm môn học thành công!');
    }
     public function edit($id){
        session()->put('id', $id);
        $this->data['title'] = 'Chỉnh sửa môn học học';
        $this->data['subject'] = Subject::find($id);
        return view('admin.subject.edit', $this->data);
    }
     public function update(Request $request){
        $id = session('id');
         $rulers = [
            'name' =>'required|min:2',
            'type' =>'required|string',
            'status' =>'required|integer'
        ];
        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'type.string' =>'Bắt buộc phải chọn',
            'status.required' =>'Trạng thái bắt buộc phải chọn!!',
            'status.integer' =>'Đừng sửa bậy!!',
        ];
        $request->validate($rulers,$messages);

        $subject = Subject::find($id);
        $subject->name = $request->name;
        $subject->status = $request->status;
        $subject->created_by = 1;
        $subject->save();
        return redirect()->route('admins.subject.list')->with('success','Cập nhật môn học thành công!');
    }
       public function delete($id){
         $subject = Subject::find($id)->delete();
         if($subject){
              return redirect()->route('admins.subject.list')->with('success','Xóa môn học thành công!');
         }
           return redirect()->route('admins.subject.list')->with('danger','Vui lòng thao tác lại!');
        }
}