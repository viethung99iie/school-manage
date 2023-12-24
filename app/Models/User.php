<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    static function singelEmail($email){
      return User::where('email', $email)->first();
    }

    static function SingelToken($token){
      return User::where('remember_token', $token)->first();
    }

    static function getAdmin(){
        $admin =  self::where('user_type',1)
                    ->where('is_deleted',0)
                    ->orderBy('id','desc');
        if(FacadesRequest::get('name')){
            $admin = $admin->where('name','like','%'.FacadesRequest::get('name').'%');
        }
        if(FacadesRequest::get('email')){
            $admin = $admin->where('email','like','%'.FacadesRequest::get('email').'%');
        }
        if(FacadesRequest::get('date')){
            $admin = $admin->whereDate('created_at','=',FacadesRequest::get('date'));
        }
        $admin = $admin->paginate(5)->withQueryString();
        return $admin;
        }

        static function changePassword($request){
            $user = User::find($request->user_id);
            $user->password = Hash::make( $request->new_password);
            $user->save();
        }
        static function changeAvartar($request){
            if($request->old_avatar!=null){
                Storage::disk('public')->delete($request->old_avatar);
            }
            $image = $request->file('avatar');
            $name = time().'_' . $image->getClientOriginalName();
            Storage::disk('public')->put($name,File::get($image));
            $imageProduct = $name;

            $user = User::find($request->user_id);
            $user->profile_pic = $imageProduct;
            $user->save();
        }

        static function findStudent($student_id){
            return self::
                        where('student_id', $student_id)
                        ->first();
        }

        static function findTeacher($teacher_id){
            return self::
                        where('teacher_id', $teacher_id)
                        ->first();
        }

        static function findParent($parent_id){
            return self::
                        where('parent_id', $parent_id)
                        ->first();
        }

        static function getByUserType($user_type){
            return self::
                        where('user_type', $user_type)
                        ->get();
        }

       

    }
