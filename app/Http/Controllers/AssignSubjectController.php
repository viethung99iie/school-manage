<?php

namespace App\Http\Controllers;

use App\Models\AssignSubject;
use App\Models\ClassModel;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignSubjectController extends Controller
{
     public $data =[];

    public function index(){
        $this->data['class'] = ClassModel::getRecordAssign();
        return view('admin.assign_subject.list',$this->data);
    }
    public function create(){
        $this->data['title'] = 'Đăng ký môn học';
        $this->data['class'] = ClassModel::getClass();
        $this->data['subjects'] = Subject::getSubject();
        return view('admin.assign_subject.create',$this->data);
    }
    public function store(Request $request){
        if(!empty($request->subject_id)){
            foreach ($request->subject_id as $subject_id) {
                $exist = AssignSubject::existClassSubject($request->class_id,$subject_id);
                if(!empty($exist)){
                    $exist->status = $request->status;
                    $exist->save();
                }else{
                    $assign_subject = new AssignSubject();
                    // $assign_subject->name = $request->name;
                    $assign_subject->class_id = $request->class_id;
                    $assign_subject->subject_id = $subject_id;
                    $assign_subject->created_by = Auth::user()->id;
                    $assign_subject->created_at = date('Y-m-d H:i:s');
                    $assign_subject->save();
                }
            }
            return redirect()->route('admins.assign_subject.list')->with('success','Đăng ký môn học thành công!!');
        }
        return redirect()->route('admins.assign_subject.list')->with('danger','Đã xảy ra lỗi vui lòng thử lại!');
    }
     public function edit($id){
        session()->put('id', $id);
        $this->data['title'] = 'Chỉnh sửa lớp học';
        $class = ClassModel::find($id);
        if(!empty($class)){
            $this->data['class'] = $class;
            $this->data['subjects'] = Subject::getSubject();
            return view('admin.assign_subject.edit', $this->data);
        }
        return redirect()->route('admins.assign_subject.list')->with('danger','Không tìm thấy trang vui lòng thử lại!');
    }
     public function update(Request $request){
        AssignSubject::deleteSubject($request->class_id);
        if(!empty($request->subject_id)){
            foreach ($request->subject_id as $subject_id) {
                $exist = AssignSubject::existClassSubject($request->class_id,$subject_id);
                if(!empty($exist)){
                    $exist->status = $request->status;
                    $exist->save();
                }else{
                    $assign_subject = new AssignSubject();
                    // $assign_subject->name = $request->name;
                    $assign_subject->class_id = $request->class_id;
                    $assign_subject->subject_id = $subject_id;
                    $assign_subject->created_by = Auth::user()->id;
                    $assign_subject->status = $request->status;
                    $assign_subject->created_at = date('Y-m-d H:i:s');
                    $assign_subject->save();
                }
            }
        }
         return redirect()->route('admins.assign_subject.list')->with('success','Cập nhật môn học thành công!!');
    }
       public function delete($id){
        $assign=  AssignSubject::deleteSubject($id);
         if($assign){
              return redirect()->route('admins.assign_subject.list')->with('success','Xóa thành công!');
         }
           return redirect()->route('admins.assign_subject.list')->with('danger','Vui lòng thao tác lại!');

}
}