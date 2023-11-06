<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ParentModel extends Model
{
    use HasFactory;
    protected $table = 'parents';

    static function getParent(){
        $parent =  self::select('parents.*','users.email as user_email','users.name as user_name', 'users.id as user_id')
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

        static function getParentByID($parent_id,$user_id=null){
             $parent = self::select('parents.*','users.name as user_name','users.email as user_email','users.id as user_id','users.mobile_number as user_mobile','users.profile_pic as user_avatar','users.status as user_status')
        ->join('users','users.parent_id','parents.id')
        ->where('parents.id',$parent_id)
        ->where('users.is_deleted',0);
        if($user_id!=null){
            $parent= $parent->where('users.id',$user_id);
        }
            $parent= $parent->first();
            return $parent;
        }

        static function updateParent($request){
             $id = session('id');
         $rulers = [
            'name' =>'required|max:50',
            'email' => 'required|email|unique:users,email,'.$request->user_id,
            'date_of_birth' =>'required',
            'address' =>'required',
            'occupation' =>'required|max:50',
            'gender' =>'required|max:50',
            'id_card' =>'required|integer',
            'date_card' =>'required',
            'nation' =>'required|max:50',
        ];
        $messages = [
            'name.required' =>'Tên bắt buộc phải nhập!!',
            'name.min' =>'Tên ít nhất :min kí tự!!',
            'email.required' =>'Email bắt buộc phải nhập!!',
            'email.email' =>'Email không đúng định dạng!',
            'email.unique' =>'Email đã tồn tại!!',
            'id_card.integer' =>'Trường này phải là số!!',
            'required' =>'Trường này bắt buộc phải nhập!!',
            'max ' => 'Tối đã :max kí tự!!',
            'min ' => 'Tối thiểu :min kí tự!!',
            'integer' => 'Trường này phải là số !!'
        ];
        $request->validate($rulers,$messages);
        $parent = ParentModel::find($id);
        $parent->date_of_birth = $request->date_of_birth;
        $parent->address = $request->address;
        $parent->occupation = $request->occupation;
        $parent->gender = $request->gender;
        $parent->id_card = $request->id_card;
        $parent->date_card = $request->date_card;
        $parent->nation = $request->nation;
        $parent->save();

        $user =  User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->status = 0;
        $user->save();
        }
}
