<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ClassTeacher;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public $data = [];

    public function attendanceStudent(Request $request){
        $this->data['title'] = 'Điểm danh học sinh';
        $this->data['class'] = ClassModel::getClass();

        if(!empty($request->get('class_id'))&& !empty($request->get('attendance'))){
             $this->data['students'] = Student::getStudentInClass($request->get('class_id'));
        }
        return view('admin.attendance.student',$this->data);
    }

    public function attendanceStudentSubmit(Request $request){
        $check_attendance = StudentAttendance::checkAlreadyAttendance($request->get('student_id'),$request->get('class_id'),$request->get('attendance_date'));
        if(!empty($check_attendance)){
            $attendance = $check_attendance;
        }else{
            $attendance = new StudentAttendance();
            $attendance->student_id = $request->get('student_id');
            $attendance->class_id = $request->get('class_id');
            $attendance->attendance_date = $request->get('attendance_date');
            $attendance->create_by = Auth::user()->id;
        }
        $attendance->attendance_type = $request->get('attendance_type');
        $attendance->save();
        $json['message'] = 'Điểm danh sinh viên thành công!!';
        echo json_encode($json);
    }

    // repost

    public function attendanceReport(Request $request){
        $this->data['title'] = 'Báo cáo điểm danh';
        $this->data['getRecord']= StudentAttendance::getAttendance();
        $this->data['class'] = ClassModel::getClass();
        return view('admin.attendance.repost',$this->data);
    }

    // teacher side

    public function attendanceStudentTeacher(Request $request){
        $this->data['title'] = 'Điểm danh học sinh';
        $this->data['class'] = ClassTeacher::getClassSubjectGroup(Auth::user()->teacher_id);

        if(!empty($request->get('class_id'))&& !empty($request->get('attendance'))){
             $this->data['students'] = Student::getStudentInClass($request->get('class_id'));
        }
        return view('teacher.attendance.student',$this->data);
    }
    public function attendanceReportTeacher(Request $request){
        $this->data['title'] = 'Báo cáo điểm danh';
        $this->data['getRecord']= StudentAttendance::getAttendance();
        $this->data['class'] = ClassTeacher::getClassSubjectGroup(Auth::user()->teacher_id);
        return view('teacher.attendance.repost',$this->data);
    }
}
