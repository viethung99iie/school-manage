<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Request as FacadesRequest;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';

     protected $fillable = [
        'name',
        'status',
        'created_by',
        'type',
    ];

static function getRecord(){
    $subjects =  self::
                    join('users','users.id','subjects.created_by')
                    ->orderBy('id','desc')
                    ->select('subjects.*','users.name as user_name');

    if(FacadesRequest::get('name')){
        $subjects = $subjects->where('subjects.name','like','%'.FacadesRequest::get('name').'%');
    }
    if(FacadesRequest::get('type')){
        $subjects = $subjects->where('subjects.type','like','%'.FacadesRequest::get('type').'%');
    }
    if(FacadesRequest::get('date')){
        $subjects = $subjects->whereDate('subjects.created_at','=',FacadesRequest::get('date'));
    }
        $subjects = $subjects->paginate(5)->withQueryString();;
    return $subjects;
}
        static function getsubject(){
            return self::where('status','0')
                    ->get();
        }

        public function Class(){
        return $this->belongsToMany(ClassModel::class,'class_subject','subject_id','class_id');
        }
}
