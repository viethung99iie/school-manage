<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\ClassModel;
use App\Models\ClassSubjectTime;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Week;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassTimeController extends Controller
{
    public $data=[];


     public function index(Request $request){
        $this->data['title'] = 'Đăng ký lịch học';
        if(!empty($request->class_id)){
            $this->data['subjects']= AssignSubject::getMySubject($request->class_id);
        }
            $week = [];
        foreach(Week::get() as $item){
            $dataW=array();
            $dataW['week_id'] = $item->id;
            $dataW['week_name'] = $item->name;

            if(!empty($request->class_id) && empty(!$request->subject_id)){
                 $time = ClassSubjectTime::getTimer($request->class_id,$request->subject_id,$item->id);
                 if(!empty($time)){
                    $dataW['start_time'] = $time->start_time;
                    $dataW['end_time'] = $time->end_time;
                    $dataW['room'] = $time->room;
                }else{
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room'] = '';
                    }
            }else{
                $dataW['start_time'] = '';
                $dataW['end_time'] = '';
                $dataW['room'] = '';
            }
            $week[] = $dataW;
        }
        $this->data['weeks'] = $week;
        $this->data['class'] = ClassModel::getRecordAssign();
        return view('admin.class_timetable.list',$this->data);
    }


    public function getSubject(Request $request){
        $getSubject = AssignSubject::getMySubject($request->class_id);
        $html = "<option value='' >Chọn</option>";
        foreach($getSubject as $value){
            $html .= "<option value ='".$value->subject_id."'>".$value->subject_name."</option>";
        }
        $json['html'] = $html;
        echo json_encode($json);
    }


    public function store(Request $request){
       $time =  ClassSubjectTime::where('class_id', $request->class_id)->where('subject_id', $request->subject_id)->delete();
        if(empty($request->subject_id) || empty($request->class_id)){
            return redirect()->back()->with('danger','Đã có lỗi sảy ra vui lòng thử lại');
        }
        foreach($request->timetable as $timetable){
            if(!empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room'])){
                $time = new ClassSubjectTime();
                $time->class_id = $request->class_id;
                $time->week_id = $timetable['week_id'];
                $time->subject_id = $request->subject_id;
                $time->start_time = $timetable['start_time'];
                $time->end_time = $timetable['end_time'];
                $time->room = $timetable['room'];
                $time->save();
            }
        }
        return redirect()->back()->with('success','Cập nhật thông tin thành công!!')->withInput();
    }
    public function delete($class_id,$subject_id,$week_id){
          $timer =   ClassSubjectTime::getTimer($class_id,$subject_id,$week_id);
          if($timer){
            $timer = $timer->delete();
            return redirect()->back()->with('success','Cập nhật dữ liêu thành công!!');
          }
          return redirect()->back()->with('warning','Dữ liêu đang trống!!');
    }
    public function deleteAll($class_id,$subject_id){
            ClassSubjectTime::where('class_id', $class_id)->where('subject_id', $subject_id)->delete();
            return redirect()->back()->with('success','Xóa dữ liêu thành công!!');
    }


    // student side
    public function myClassTime(){
        $this->data['title'] = 'Thời khóa biểu';
            $result = array();
            $dataS = [];
            $student = Student::find(Auth::user()->student_id);
            $subjects = AssignSubject::getMySubject($student->class_id);
            foreach($subjects as $subject){
                $dataS['name'] = $subject->subject_name;
                $week = array();
                foreach(Week::get() as $item){
                    $dataW=array();
                    $dataW['week_name'] = $item->name;
                    $time = ClassSubjectTime::getTimer($student->class_id,$subject->subject_id,$item->id);
                 if(!empty($time)){
                    $dataW['start_time'] = $time->start_time;
                    $dataW['end_time'] = $time->end_time;
                    $dataW['room'] = $time->room;
                }else{
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room'] = '';
                    }
                    $week[] = $dataW;
                }
                $dataS['weeks'] =  $week;
                $result[] = $dataS;
            }
            $this->data['subjects'] = $result;
            // dd($this->data['subjects']);
        return view('student.class_time',$this->data);
    }

    // teacher side
    public function teacherTime($class_id,$subject_id){
        $this->data['title'] = 'Lịch giảng dạy';
        $this->data['class_name']= ClassModel::find($class_id)->name;
        $this->data['subject_name']= Subject::find($subject_id)->name;
            $week = [];
        foreach(Week::get() as $item){
            $dataW=array();
            $dataW['week_name'] = $item->name;

                 $time = ClassSubjectTime::getTimer($class_id,$subject_id,$item->id);
                 if(!empty($time)){
                    $dataW['start_time'] = $time->start_time;
                    $dataW['end_time'] = $time->end_time;
                    $dataW['room'] = $time->room;
                }else{
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room'] = '';
                    }
                    $week[] = $dataW;
                }
        $this->data['weeks'] = $week;
        return view('teacher.class_time',$this->data);
    }

    // teacher side
    public function myStudentTime($class_id,$subject_id){
        $this->data['title'] = 'Lịch học của con';
        $this->data['class_name']= ClassModel::find($class_id)->name;
        $this->data['subject_name']= Subject::find($subject_id)->name;
            $week = [];
        foreach(Week::get() as $item){
            $dataW=array();
            $dataW['week_name'] = $item->name;

                 $time = ClassSubjectTime::getTimer($class_id,$subject_id,$item->id);
                 if(!empty($time)){
                    $dataW['start_time'] = $time->start_time;
                    $dataW['end_time'] = $time->end_time;
                    $dataW['room'] = $time->room;
                }else{
                    $dataW['start_time'] = '';
                    $dataW['end_time'] = '';
                    $dataW['room'] = '';
                    }
                    $week[] = $dataW;
                }
        $this->data['weeks'] = $week;
        // dd($this->data['weeks']);
        return view('parent.class_time',$this->data);
    }
}