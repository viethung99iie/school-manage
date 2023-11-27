<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Exam extends Model
{
     protected $table = 'exams';

     static public function getExams(){
        $exam= self::select('exams.*', 'users.name as user_name')
                    ->join('users','users.id','exams.create_by')
                    ->orderBy('exams.created_at','desc');
                    if(Request::get('name')){
                        $exam = $exam->where('exams.name','like','%'.Request::get('name').'%');
                    }
                    if(Request::get('date')){
                        $exam = $exam->where('exams.created_at','like','%'.Request::get('date').'%');
                    }

                   $exam= $exam->paginate(50)->withQueryString();
                    return $exam;
     }

}
