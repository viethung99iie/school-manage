<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    protected $table = 'exam_schedule';


    // lấy tất cả data bằng class_id và subject_id
    static function getSchedule($exam_id, $class_id,$subject_id=null){
         $schedule = self::where('class_id', $class_id)
                    ->select('exam_schedule.*','class.name as class_name','subjects.name as subject_name')
                    ->join('class', 'class.id','exam_schedule.class_id')
                    ->join('subjects', 'subjects.id','exam_schedule.subject_id')
                    ->where('exam_id', $exam_id);
                if(!empty($subject_id)){
                     $schedule = $schedule->where('subject_id', $subject_id);
                }
                    $schedule = $schedule->first();
                return $schedule;
    }

    // lấy tất cả data bằng class_id và subject_id
    static function getSubject($exam_id, $class_id){
        return self::where('class_id', $class_id)
                    ->select('exam_schedule.*','class.name as class_name','subjects.name as subject_name')
                    ->join('class', 'class.id','exam_schedule.class_id')
                    ->join('subjects', 'subjects.id','exam_schedule.subject_id')
                    ->where('exam_id', $exam_id)
                    ->get();
    }



    // lấy tất cả data bằng class_id và subject_id
    static function getScheduleS($exam_id, $class_id,$subject_id=null){
         $schedule = self::where('class_id', $class_id)
                    ->select('exam_schedule.*','class.name as class_name','subjects.name as subject_name')
                    ->join('class', 'class.id','exam_schedule.class_id')
                    ->join('subjects', 'subjects.id','exam_schedule.subject_id')
                    ->where('exam_id', $exam_id);
                if(!empty($subject_id)){
                     $schedule = $schedule->where('subject_id', $subject_id);
                }
                    $schedule = $schedule->get();
                return $schedule;
    }

    static function getExam($class_id){
         return  self::where('class_id', $class_id)
                        ->select('exam_schedule.*','exams.name as exam_name')
                        ->join('exams','exams.id','exam_schedule.exam_id')
                        ->groupBy('exam_schedule.exam_id')
                        ->orderBy('exams.id','asc')
                        ->get();
    }
    static function getExamTeacher($teacher_id){
         return  self::where('class_teacher.teacher_id', $teacher_id)
                        ->select('exam_schedule.*','exams.name as exam_name')
                        ->join('exams','exams.id','exam_schedule.exam_id')
                        ->join('class_teacher','class_teacher.class_id','exam_schedule.class_id')
                        ->groupBy('exam_schedule.exam_id')
                        ->orderBy('exams.id','asc')
                        ->get();
    }

    static function getExamTimetable($teacher_id){
        return self::select('exam_schedule.*','class.name as class_name','subjects.name as subject_name' ,'exams.name as exam_name')
                    ->join('class_teacher','class_teacher.class_id','exam_schedule.class_id')
                    ->join('class', 'class.id','exam_schedule.class_id')
                    ->join('subjects', 'subjects.id','exam_schedule.subject_id')
                    ->join('exams','exams.id','exam_schedule.exam_id')
                    ->where('class_teacher.teacher_id', $teacher_id)
                    ->get();
    }

    static function getMark($student_id,$exam_id,$class_id,$subject_id){
        return Mark::checkAlreadyMark($student_id,$exam_id,$class_id,$subject_id);
    }
}