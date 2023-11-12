<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\ClassModel;
use App\Models\ClassTeacher;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTeacherController extends Controller
{
    public $data =[];
    public function index(){
        $this->data['title'] = 'Giáo Viên chủ nhiệm';
        $this->data['class'] = ClassModel::getClassTeacher();
        return view('admin.class_teacher.list',$this->data);
    }
    public function create(){
        $this->data['title'] = 'Đăng ký GVCN';
        $this->data['class'] = ClassModel::getClass();
        $this->data['teachers'] = Teacher::All();
        return view('admin.class_teacher.create',$this->data);
    }
     public function store(Request $request){
        if(!empty($request->teacher_id)){
            foreach ($request->teacher_id as $teacher_id) {
                $exist = ClassTeacher::existClassTeacher($request->class_id,$teacher_id);
                if(!empty($exist)){
                    $exist->status = $request->status;
                    $exist->save();
                }else{
                    $class_teacher = new ClassTeacher();
                    $class_teacher->class_id = $request->class_id;
                    $class_teacher->teacher_id = $teacher_id;
                    $class_teacher->created_at = date('Y-m-d H:i:s');
                    $class_teacher->save();
                }
            }
            return redirect()->route('admins.class_teacher.list')->with('success','Đăng ký môn học thành công!!');
        }
        return redirect()->route('admins.class_teacher.list')->with('danger','Đã xảy ra lỗi vui lòng thử lại!');
    }
     public function edit($id){
        session()->put('id', $id);
        $this->data['title'] = 'Cập nhật GVCN';
        $class = ClassModel::find($id);
        if(!empty($class)){
            $this->data['class'] = $class;
            $this->data['teachers'] = Teacher::all();
            return view('admin.class_teacher.edit', $this->data);
        }
        return redirect()->route('admins.class_teacher.list')->with('danger','Không tìm thấy trang vui lòng thử lại!');
    }

     public function update(Request $request){
        ClassTeacher::deleteTeacher($request->class_id);
        if(!empty($request->teacher_id)){
            foreach ($request->teacher_id as $teacher_id) {
                 $exist = ClassTeacher::existClassTeacher($request->class_id,$teacher_id);
                if(!empty($exist)){
                    $exist->status = $request->status;
                    $exist->save();
                }else{
                    $class_teacher = new ClassTeacher();
                    $class_teacher->class_id = $request->class_id;
                    $class_teacher->teacher_id = $teacher_id;
                    $class_teacher->created_at = date('Y-m-d H:i:s');
                    $class_teacher->save();
                }
            }
        }
         return redirect()->route('admins.class_teacher.list')->with('success','Cập nhật môn học thành công!!');
    }
       public function delete($id){
        $assign=  ClassTeacher::deleteTeacher($id);
         if($assign){
              return redirect()->route('admins.class_teacher.list')->with('success','Xóa thành công!');
         }
           return redirect()->route('admins.class_teacher.list')->with('danger','Vui lòng thao tác lại!');

}

// teacher side

        public function MyClassSubject(){
                $this->data['title'] = 'Giáo Viên chủ nhiệm';
                $this->data['class'] = ClassTeacher::getClassSubject(Auth::user()->teacher_id);
                return view('teacher.class_subject.my_class_subject',$this->data);
            }
        public function MyStudent($class_id){
                $this->data['title'] = 'Danh sách học sinh';
                $this->data['class_name'] = ClassModel::find($class_id)->name;
                $this->data['students'] = Student::getStudentInClass($class_id);
                return view('teacher.class_subject.my_student',$this->data);
        }

}
