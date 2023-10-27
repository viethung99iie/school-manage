<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ParentModel extends Model
{
    use HasFactory;
    protected $table = 'parents';

    static function getparent(){
        $parent =  self::select('parents.*','users.email as user_email','users.name as user_name')
        ->join('users','users.parent_id','parents.id')
        ->orderBy('users.created_at','desc')
        ->where('users.user_type',4)
        ->where('users.is_deleted',0);
        if(FacadesRequest::get('name')){
            $parent = $parent->where('users.name','like','%'.FacadesRequest::get('name').'%');
        }
        if(FacadesRequest::get('email')){
            $parent = $parent->where('users.email','like','%'.FacadesRequest::get('email').'%');
        }
        $parent = $parent->paginate(5)->withQueryString();;
        return $parent;
        }

        static function getParentByID($id){
             return self::select('parents.*','users.name as user_name','users.email as user_email')
        ->join('users','users.parent_id','parents.id')
        ->orderBy('users.created_at','desc')
        ->where('parents.id',$id)
        ->where('users.is_deleted',0)
        ->first();
        }
}