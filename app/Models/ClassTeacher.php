<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
   protected $table = 'class_teacher';

     protected $fillable = [
        'class_id',
        'teacher_id',
    ];
     static function getClassSubject($teacher_id){
        $assign =  self::select('class_teacher.*','class.name as class_name','subjects.name as subject_name','subjects.type as subject_type','subjects.id as subject_id',)
                        ->join('class','class.id','class_teacher.class_id')
                        ->join('class_subject', 'class_subject.class_id',  'class.id')
                        ->join('subjects', 'subjects.id', 'class_subject.subject_id')
                        ->where('class_teacher.teacher_id',$teacher_id)
                        ->paginate(100)->withQueryString();
        return $assign;
        }
    //  static function  getClassSubject($teacher_id){
    //     $assign =  self::select('class_teacher.*','class.name as class_name')
    //                     ->join('class','class.id','class_teacher.class_id')
    //                     ->where('class_teacher.teacher_id',$teacher_id)
    //                     ->paginate(100)->withQueryString();
    //     return $assign;
    //     }
        static function existClassTeacher($class_id,$teacher_id){
            return self::where('class_id',$class_id)->where('teacher_id',$teacher_id)->first();
        }
         static function getTeacherByClassId($class_id){
            return self::where('class_id',$class_id)
                        ->get();
        }
        static function deleteTeacher($class_id){
            return self::where('class_id',$class_id)->delete();
        }

         static function getMyTeacher($class_id){
            $assign =  self::select('Teachers.name as Teacher_name','Teachers.type as Teacher_type')
                        ->join('Teachers','Teachers.id','class_Teacher.Teacher_id')
                        ->where('class_id','=',$class_id)
                        ->orderBy('class_Teacher.id','desc')
                        ->get();
        return $assign;
        }
}