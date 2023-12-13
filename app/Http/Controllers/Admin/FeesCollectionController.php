<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\FeeCollect;
use App\Models\Mark;
use App\Models\Setting;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class FeesCollectionController extends Controller
{
    public $data = [];

    public function index(Request $request){
        $this->data['class'] = ClassModel::getRecord();
         $this->data['exam'] = Exam::getExams();
        $this->data['getRecord'] = FeeCollect::getCollectFeeStudent();
        $this->data['title'] = 'Học phí';
        return view('admin.fee_collection.collect_fee',$this->data);
    }
    // student side
    public function myFeeCollect(){
        $this->data['title'] = 'Học phí của tôi';
        $fee = Mark::getFeeCollectStudent();
        $result = [];
        foreach($fee as $value){
            $dataF = [];
            $dataF['exam_name'] = $value->exam_name;
            $dataF['amount'] = $value->amount;
            $dataF['exam_id'] = $value->exam_id;
            $dataF['class_id'] = $value->class_id;
            $dataF['payment_date']='';
            $status = FeeCollect::checkFeeStudent($value->exam_id,$value->class_id,Auth::user()->student_id);
            if(!empty($status)){
                $dataF['payment_date'] = $status->created_at;
                $dataF['status'] = 1;
            }else{
                $dataF['status'] = 0;
            }
            $result[]=  $dataF;
        }
        $this->data['fee'] = $result;
        return view('student.fee_collect',$this->data);
    }

    public function paypalStudent(Request $request){
        $price = $request->amount/25000;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken=  $provider->getAccessToken();
        $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context"=> [
                    "brand_name" => " Thanh toán học phí",
                    "return_url" => route('students.paypal_success'),
                    "cancel_url" => route('students.paypal_error')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                                "currency_code"=> "USD",
                                "value" => $price
                        ]
                    ]
                ]
        ]);
        if(isset($response['id']) && $response['id']!=null){
            foreach ($response['links'] as $link) {
                if($link['rel']=='approve'){
                    session()->put('class_id', $request->class_id);
                    session()->put('amount', $request->amount);
                    session()->put('exam_id', $request->exam_id);
                    return redirect()->away($link['href']);
                }
            }

        }else{
            return redirect()->route('students.paypal_error');
        }
    }

    public function paymentError(){
         return 'Payment is Error';
    }
     public function paymentSuccess(Request $request){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken=  $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        if(isset($response['status']) && $response['status']=='COMPLETED'){
                $class_id = session()->get('class_id');
                $exam_id = session()->get('exam_id');
                $amount = session()->get('amount');
                $fee_collect = new FeeCollect();
                $fee_collect->exam_id = $exam_id;
                $fee_collect->class_id = $class_id;
                $fee_collect->amount = $amount;
                $fee_collect->student_id = Auth::user()->student_id;
                $fee_collect->status = 1;
                $fee_collect->save();
                return redirect()->route('students.fee_collect')->with('success','Thanh toán thành công!!');
        }else{
            return redirect()->route('students.paypal_error');
        }
    }

}