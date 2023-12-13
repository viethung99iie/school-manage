<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
      protected $table = 'marks';

      static function checkAlreadyMark($student_id,$exam_id,$class_id,$subject_id){
        return self::where('student_id',$student_id)
                    ->where('exam_id',$exam_id)
                    ->where('class_id',$class_id)
                    ->where('subject_id',$subject_id)
                    ->first();
      }

       static function getExam($student_id){
        return self::where('marks.student_id',$student_id)
                    ->join('exams','exams.id','marks.exam_id')
                    ->select('marks.*','exams.name as exam_name')
                    ->groupBy('marks.exam_id')
                    ->get();
       }
       static function getExamSubject($exam_id,$student_id){
        return self::select('marks.*','exams.name as exam_name', 'subjects.name as subject_name')
                    ->join('exams','exams.id','marks.exam_id')
                    ->join('subjects', 'subjects.id','marks.subject_id')
                    ->where('marks.student_id',$student_id)
                    ->where('marks.exam_id',$exam_id)
                    ->get();
       }
       static function getFeeCollectStudent(){
        return self::select('marks.*','exams.name as exam_name','class.amount as amount')
                    ->join('exams','exams.id','marks.exam_id')
                    ->join('class','class.id', 'marks.class_id')
                    ->groupBy('marks.exam_id')
                    ->get();
       }

}
