<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\sendEmailUser;
use App\Models\NoticeBoard;
use App\Models\NoticeBoardMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;

class CommunicateController extends Controller
{
        public $data = [];


    public function sendEmail(){
        $this->data['title'] = 'Thông báo bằng Email';
        return view('admin.communicate.send_email',$this->data);
    }
    public function sendEmailUser(Request $request){
        if(!empty($request->messto)){
            foreach($request->messto as $user_type){
                $users = User::getByUserType($user_type);
                foreach ($users as $user) {
                    $user->send_message = $request->message;
                    $user->send_title = $request->title;
                    Mail::to($user->email)->send(new sendEmailUser($user));
                }
            }
        }
        return redirect()->route('admins.communicate.send_email')->with('success','Đã gửi mail thành công!!');
    }

    public function list(){
        $this->data['title'] = 'Thông báo';
        $this->data['notice'] = NoticeBoard::getNotice();
        return view('admin.communicate.noticeboard.list',$this->data);
    }
    public function create(){
        $this->data['title'] = 'Thông báo mới';
        return view('admin.communicate.noticeboard.create',$this->data);
    }
    public function store(Request $request){
        $notice = new NoticeBoard();
        $notice->title = $request->title;
        $notice->notice_date = $request->notice_date;
        $notice->publish_date = $request->publish_date;
        $notice->message = $request->message;
        $notice->create_by = Auth::user()->id;
        $notice->save();
        foreach ($request->messto as $value) {
            $mess = new NoticeBoardMessage();
            $mess->mess_to = $value;
            $mess->notice_board_id = $notice->id;
            $mess->save();
        }
        return redirect()->route('admins.communicate.list')->with('success','Đã thêm mới thông báo thành công!');
    }
    public function edit($id){
        session()->put('id', $id);
        $this->data['title'] = 'Chỉnh sửa thông báo';
        $this->data['notice'] = NoticeBoard::find($id);
        return view('admin.communicate.noticeboard.edit', $this->data);
    }
     public function update(Request $request){
        $id = session('id');
        $notice = NoticeBoard::find($id);
        $notice->title = $request->title;
        $notice->notice_date = $request->notice_date;
        $notice->publish_date = $request->publish_date;
        $notice->message = $request->message;
        $notice->create_by = Auth::user()->id;
        $notice->save();
         NoticeBoardMessage::deleteAll($id);
        foreach ($request->messto as $value) {
            $mess = new NoticeBoardMessage();
            $mess->mess_to = $value;
            $mess->notice_board_id = $notice->id;
            $mess->save();
        }
        return redirect()->route('admins.communicate.list')->with('success','Cập nhật thông báo thành công!');
    }
       public function delete($id){
         $notice = NoticeBoard::find($id)->delete();
         NoticeBoardMessage::deleteAll($id);
         if($notice){
              return redirect()->route('admins.communicate.list')->with('success','Xóa thông báo thành công!');
         }
           return redirect()->route('admins.communicate.list')->with('danger','Vui lòng thao tác lại!');
        }


        // student side
        public function myNoticeStudent(){
            $this->data['title'] = 'Thông báo';
            $this->data['notice'] = NoticeBoard::getNoticeUser(Auth::user()->user_type);
        return view('student.notice_board',$this->data);
        }

        // teacher side
        public function myNoticeTeacher(){
            $this->data['title'] = 'Thông báo';
            $this->data['notice'] = NoticeBoard::getNoticeUser(Auth::user()->user_type);
        return view('teacher.notice_board',$this->data);
        }

        // parent side
        public function myNoticeParent(){
            $this->data['title'] = 'Thông báo';
            $this->data['notice'] = NoticeBoard::getNoticeUser(Auth::user()->user_type);
        return view('parent.notice_board',$this->data);
        }

}