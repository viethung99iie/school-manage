<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\ClassModel;
use App\Models\ClassTeacher;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\Mark;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class ExaminationController extends Controller
{

    public $data = [];

    public function index(){
         $this->data['title'] = 'Danh sách bài thi';
         $this->data['exams'] = Exam::getExams();
        return view('admin.examinations.exam.list',$this->data);
    }
    public function create(){
        $this->data['title'] = 'Thêm bài thi';
        return view('admin.examinations.exam.create',$this->data);
    }
    public function store(Request $request){
        $rulers = [
            'name' =>'required|min:5',
            'note' =>'required|min:6|max:2000'
        ];
        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'note.required' =>'Mật khẩu bắt buộc phải nhập!!',
            'note.min' =>'Mật khẩu ít nhất :min kí tự!!',
            'note.max' =>'Tối đa kí tự là 2000!!',
        ];
        $request->validate($rulers,$messages);

        $exam = new Exam();
        $exam->name = $request->name;
        $exam->note = $request->note;
        $exam->create_by = Auth::user()->id;
        $exam->save();
        return redirect()->route('admins.examinations.exam.list')->with('success','Thêm quản trị viên thành công!');
    }

    public function edit($id){
        session()->put('id', $id);
        $this->data['title'] = 'Chỉnh sửa kì thi';
        $this->data['exam'] = Exam::find($id);
        return view('admin.examinations.exam.edit', $this->data);
    }

    public function update(Request $request){
        $id = session('id');
        $rulers = [
            'name' =>'required|min:5',
            'note' =>'required|min:6|max:2000'
        ];
        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'note.required' =>'Mật khẩu bắt buộc phải nhập!!',
            'note.min' =>'Mật khẩu ít nhất :min kí tự!!',
            'note.max' =>'Tối đa kí tự là 2000!!',
        ];
        $request->validate($rulers,$messages);

        $exam = Exam::find($id);
        $exam->name = $request->name;
        $exam->note = $request->note;
        $exam->save();
        return redirect()->route('admins.examinations.exam.list')->with('success','Cập nhật kì thi thành công');
    }

    public function delete($id){
         $exam = Exam::find($id);
         $exam->delete();
         return redirect()->back()->with('success','Xóa thành công kì thi!');
    }

    public function schedule(Request $request){
        $this->data['title'] = 'Đăng kí lịch thi';
        $this->data['exams'] = Exam::getExams();
        $this->data['class'] = ClassModel::getClass();
        $class = [];
        foreach(ClassModel::getClass() as $item){
            $temp = [];
            $temp['id'] = $item->id;
            $temp['name'] = $item->name;
            $class[] = $temp;
        }
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id'))){
            $subjects = AssignSubject::getMySubject($request->get('class_id'));
            $result = [];
        foreach($subjects as $item){
            $dataS=array();
            $dataS['subject_id'] = $item->subject_id;
            $dataS['subject_name'] = $item->subject_name;

                 $schedule = ExamSchedule::getSchedule($request->exam_id,$request->class_id,$item->subject_id);
                 if(!empty($schedule)){
                    $dataS['exam_date'] = $schedule->exam_date;
                    $dataS['start_time'] = $schedule->start_time;
                    $dataS['end_time'] = $schedule->end_time;
                    $dataS['room'] = $schedule->room;
                    $dataS['full_mark'] = $schedule->full_mark;
                    $dataS['pass_mark'] = $schedule->pass_mark;
                }else{
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room'] = '';
                    $dataS['full_mark'] = '';
                    $dataS['pass_mark'] = '';

                    }
            $result[] = $dataS;
        }
        $this->data['subjects'] = $result;
    }
        $this->data['class'] = $class;
        return view('admin.examinations.schedule.list',$this->data);
    }
    public function scheduleStore(Request $request){
       $schedule =  ExamSchedule::where('class_id', $request->class_id)->where('exam_id', $request->exam_id)->delete();
        if(empty($request->exam_id) || empty($request->class_id)){
            return redirect()->back()->with('danger','Đã có lỗi sảy ra vui lòng thử lại');
        }
        foreach($request->timetable as $timetable){
            if(!empty($timetable['start_time']) && !empty($timetable['end_time']) && !empty($timetable['room'])&& !empty($timetable['full_mark']) && !empty($timetable['pass_mark'])){
                $schedule = new ExamSchedule();
                $schedule->class_id = $request->class_id;
                $schedule->exam_id = $request->exam_id;
                $schedule->subject_id = $timetable['subject_id'];
                $schedule->start_time = $timetable['start_time'];
                $schedule->exam_date = $timetable['exam_date'];
                $schedule->end_time = $timetable['end_time'];
                $schedule->room = $timetable['room'];
                $schedule->full_mark = $timetable['full_mark'];
                $schedule->pass_mark = $timetable['pass_mark'];
                $schedule->create_by = Auth::user()->id;
                $schedule->save();
            }
        }
        return redirect()->back()->with('success','Cập nhật thông tin thành công!!')->withInput();
    }
    public function scheduleDelete($exam,$class_id,$subject_id){
          $schedule =   ExamSchedule::getSchedule($exam,$class_id,$subject_id);
          if($schedule){
            $schedule = $schedule->delete();
            return redirect()->back()->with('success','Cập nhật dữ liêu thành công!!');
          }
          return redirect()->back()->with('warning','Dữ liêu đang trống!!');
    }
    public function scheduleDeleteAll($exam_id,$class_id){
            ExamSchedule::where('exam_id', $exam_id)->where('class_id', $class_id)->delete();
            return redirect()->back()->with('success','Xóa dữ liêu thành công!!');
    }

        // mark register

        public function mark_register(Request $request){
        $this->data['title'] = 'Đăng ký điểm thi các môn';
        $this->data['exams'] = Exam::getExams();
        $this->data['class'] = ClassModel::getClass();
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $this->data['subjects'] = ExamSchedule::getSubject($request->get('exam_id'),$request->get('class_id'));
             $this->data['students'] = Student::getStudentClass($request->get('class_id'));
            }
        return view('admin.examinations.mark_register',$this->data);
        }

        public function store_mark(Request $request){
            if(!empty($request->mark)){
                foreach($request->mark as $mark){
                    $class_work = !empty($mark['class_work'])? $mark['class_work']:0;
                    $home_work = !empty($mark['home_work'])? $mark['home_work']:0;
                    $test_work = !empty($mark['test_work'])? $mark['test_work']:0;
                    $exam = !empty($mark['exam'])? $mark['exam']:0;

                    $getMark = Mark::checkAlreadyMark($request->student_id,$request->exam_id,$request->class_id,$mark['subject_id']);
                    if(!empty($getMark)){
                         $saveMark = $getMark;
                    }else{
                         $saveMark = new Mark();
                         $saveMark->create_by = Auth::user()->id;
                    }
                    $saveMark->student_id = $request->student_id;
                    $saveMark->class_id = $request->class_id;
                    $saveMark->exam_id = $request->exam_id;
                    $saveMark->subject_id = $mark['subject_id'];
                    $saveMark->class_work = $class_work;
                    $saveMark->home_work = $home_work;
                    $saveMark->test_work = $test_work;
                    $saveMark->exam = $exam;

                    $saveMark->save();
                }
                $json['message'] = 'Mark saved successfully';
                echo json_encode($json);
            }
        }
        public function store_mark_single(Request $request){
            dd($request->all());
        }

// student work side
    public function MyExamTimeTable(){
        $this->data['title'] = 'Lịch thi của tôi';
        $student = Student::find(Auth::user()->student_id);
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
            $this->data['getRecord'] = $result;
            return view('student.my_exam_table',$this->data);

    }





    // teacher side work
    public function MyExamTimeTableTeacher(){
        $this->data['title'] = 'Lịch thi các môn học';
         $getClass = ClassTeacher::getClassSubjectGroup(Auth::user()->teacher_id);
         $result = [];
        foreach($getClass as $class){
            $dataC = [];
            $dataC['class_name']= $class->class_name;
            $exam = ExamSchedule::getExam($class->class_id);
            $examArr = [];
            foreach ($exam as $itemE) {
                $dataE = [];
                    $dataE['exam_name'] = $itemE->exam_name;
                    $schedule = ExamSchedule::getScheduleS($itemE->exam_id,$class->class_id);
                    $subjectArr = [];
                    foreach ($schedule as $valueS){
                        $dataS= [];
                        $dataS['subject_name'] = $valueS->subject_name;
                        $dataS['exam_date'] = $valueS->exam_date;
                        $dataS['start_time'] = $valueS->start_time;
                        $dataS['end_time'] = $valueS->end_time;
                        $dataS['room'] = $valueS->room;
                        $dataS['full_mark'] = $valueS->full_mark;
                        $dataS['pass_mark'] = $valueS->pass_mark;
                         $subjectArr[] = $dataS;
                    }
                    $dataE['subject'] = $subjectArr;
                    $examArr[] = $dataE;
            }
            $dataC['exam'] = $examArr;
            $result[] = $dataC;
        }
        $this->data['getRecord'] = $result;
        return view('teacher.my_exam_table',$this->data);
    }

    public function MyStudentExamTimeTable($student_id){
         $this->data['title'] = 'Lịch thi của con tôi';
         $student = Student::find($student_id);
        $exam = ExamSchedule::getExam($student->class_id);
        $this->data['student_name'] = User::findStudent($student_id)->student_name;
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
            $this->data['getRecord'] = $result;
           return view('parent.my_exam_table',$this->data);
    }
}