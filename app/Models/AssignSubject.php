<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AssignSubject extends Model
{
    protected $table = 'class_subject';

     protected $fillable = [
        'class_id',
        'subject_id',
        'created_by',
    ];

     static function getRecord(){
        $assign =  self::select('class_subject.*','users.name as user_name','class.name as class_name','subjects.name as subject_name')
                        ->join('users','users.id','class_subject.created_by')
                        ->join('subjects','subjects.id','class_subject.subject_id')
                        ->join('class','class.id','class_subject.class_id')
                        ->orderBy('class_subject.id','desc');
        // if(FacadesRequest::get('name')){
        //     $class = $class->where('class.name','like','%'.FacadesRequest::get('name').'%');
        // }
        // if(FacadesRequest::get('date')){
        //     $class = $class->whereDate('class.created_at','=',FacadesRequest::get('date'));
        // }
        $assign = $assign->paginate(5)->withQueryString();;
        return $assign;
        }
        static function existClassSubject($class_id,$subject_id){
            return self::where('class_id',$class_id)->where('subject_id',$subject_id)->first();
        }
         static function getSubjectByClassId($class_id){
            return self::where('class_id',$class_id)
                        ->get();
        }
        static function deleteSubject($class_id){
            return self::where('class_id',$class_id)->delete();
        }

}