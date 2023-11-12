<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.subject.create',$this->data);
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

// student side

        public function mySubject(){
             $this->data['title'] = 'Môn học của tôi';
             $student = Student::find(Auth::user()->student_id);
              $this->data['subjects'] = AssignSubject::getMySubject($student->class_id);
            return view('student.my_subject',$this->data);
        }

// parent side

         public function myStudentSubject($student_id){
            $this->data['title'] = 'Môn học con tôi';
            $student = Student::getStudentByID($student_id);
            $this->data['student_name'] =  $student->user_name;
            $this->data['subjects'] = AssignSubject::getMySubject($student->class_id);
            $this->data['class_id'] = $student->class_id;
            return view('parent.subject_student',$this->data);
        }
}