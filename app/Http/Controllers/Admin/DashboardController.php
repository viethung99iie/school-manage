<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\FeeCollect;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
        public $data =[];

        public function index(){
         if(Auth::user()->user_type === 1){
                $this->data['totalFee'] = FeeCollect::getTotal();
                $this->data['totalFeeToday'] = FeeCollect::getTotalTodate();
                $this->data['totalAdmin'] = User::getByUserType(1);
                $this->data['totalTeacher'] = User::getByUserType(2);
                $this->data['totalStudent'] = User::getByUserType(3);
                $this->data['totalParent'] = User::getByUserType(4);
                $this->data['totalClass'] = ClassModel::getTotalClass();
                $this->data['totalSubject'] = Subject::getTotalSubject();
                return view('admin/dashboard',$this->data);
            }
            if(Auth::user()->user_type === 2){
                 return view('teacher/dashboard');
            }
            if(Auth::user()->user_type === 3){
                 return view('student/dashboard');
            }
            if(Auth::user()->user_type === 4){
                 return view('parent/dashboard');
            }
    }


}