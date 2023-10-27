<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ClassModel extends Model
{
    protected $table = 'class';

     protected $fillable = [
        'name',
        'status',
        'created_by',
    ];

     static function getRecord(){
        $class =  self::
                        join('users','users.id','class.created_by')
                        ->orderBy('id','desc')
                        ->select('class.*','users.name as user_name');

        if(FacadesRequest::get('name')){
            $class = $class->where('class.name','like','%'.FacadesRequest::get('name').'%');
        }
        if(FacadesRequest::get('date')){
            $class = $class->whereDate('class.created_at','=',FacadesRequest::get('date'));
        }
        $class = $class->paginate(5)->withQueryString();;
        return $class;
        }
        static function getClass(){
            return self::where('status','0')
                    ->get();
        }
        public function Subjects(){
            return $this->belongsToMany(Subject::class,'class_subject','class_id','subject_id');
        }
    static function getRecordAssign(){
        $class = self::join('users', 'users.id', 'class.created_by')
                    ->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('class_subject')
                            ->whereRaw('class_subject.class_id = class.id');
                    })
                    ->orderBy('created_at', 'desc')
                    ->select('class.*', 'users.name as user_name');

        if(FacadesRequest::get('name')){
            $class = $class->where('class.name','like','%'.FacadesRequest::get('name').'%');
        }
        if(FacadesRequest::get('date')){
            $class = $class->whereDate('class.created_at','=',FacadesRequest::get('date'));
        }
        $class = $class->paginate(5)->withQueryString();;
        return $class;
    }
}
