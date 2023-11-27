<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\ClassSubjectTime;
use App\Models\ClassTeacher;
use App\Models\ExamSchedule;
use App\Models\Student;
use App\Models\User;
use App\Models\Week;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
        public $data = [];

    public function myCalendar(){
        $this->data['getRecord'] = $this->MyTimeTable(Auth::user()->student_id);
        $this->data['examTime'] = $this->myExamTimeTable(Auth::user()->student_id);
        $this->data['title'] = 'Thời khóa biểu';
        return view('student.my_calendar',$this->data);
    }
    public function MyTimeTable($student_id){
        $result = array();
            $dataS = [];
            $student = Student::find($student_id);
            $subjects = AssignSubject::getMySubject($student->class_id);
            foreach($subjects as $subject){
                $dataS['name'] = $subject->subject_name;
                $week = array();
                foreach(Week::get() as $item){
                    $dataW=array();
                    $dataW['week_name'] = $item->name;
                    $dataW['fullcalendar_day'] = $item->fullcalendar_day;
                    $time = ClassSubjectTime::getTimer($student->class_id,$subject->subject_id,$item->id);
                 if(!empty($time)){
                    $dataW['start_time'] = $time->start_time;
                    $dataW['end_time'] = $time->end_time;
                    $dataW['room'] = $time->room;
                    $week[] = $dataW;
                }
                }
                $dataS['weeks'] =  $week;
                $result[] = $dataS;
            }
        return $result;
    }
    public function myExamTimeTable($student_id){
        $student = Student::find($student_id);
        $exam = ExamSchedule::getExam($student->class_id);
        $result = [];
        foreach ($exam as $itemE) {
            $dataE = [];
            $dataE['name'] = $itemE->exam_name;
            $examArr[]= $dataE;
            $schedule = ExamSchedule::getScheduleS($itemE->exam_id,$itemE->class_id);
            $resultS = [];
                foreach ($schedule as $valueS){
                    $dataS= [];
                    $dataS['subject_name'] = $valueS->subject_name;
                    $dataS['exam_date'] = $valueS->exam_date;
                    $dataS['start_time'] = $valueS->start_time;
                    $dataS['end_time'] = $valueS->end_time;
                    $dataS['room'] = $valueS->room;
                    $dataS['full_mark'] = $valueS->full_mark;
                    $dataS['pass_mark'] = $valueS->pass_mark;
                        $resultS[] = $dataS;
                }
            $dataE['exam']= $resultS;
            $result[] = $dataE;
        }
        return $result;
    }
    public function myStudentCalendar($student_id){
        $this->data['student_name'] = User::findStudent($student_id)->student_name;
        $this->data['getRecord'] = $this->MyTimeTable($student_id);
        $this->data['examTime'] = $this->myExamTimeTable($student_id);
        $this->data['title'] = 'Thời khóa biểu';
        return view('parent.my_calendar',$this->data);
    }
    public function myCalendarTeacher(){
         $this->data['title'] = 'Lịch giảng dạy';
         $this->data['classTimetable'] = ClassTeacher::getCalendarTeacher(Auth::user()->teacher_id);
         $this->data['examTimetable'] = ExamSchedule::getExamTimetable(Auth::user()->teacher_id);
        return view('teacher.my_calendar',$this->data);
    }
}