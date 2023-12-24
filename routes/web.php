<?php


use App\Http\Controllers\Admin\AssignSubjectController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\User\Teacher\ProfileController as TeacherProfileController;
use App\Http\Controllers\User\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\User\Parent\ProfileController as ParentProfileController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ClassTeacherController;
use App\Http\Controllers\Admin\ClassTimeController;
use App\Http\Controllers\Admin\ExaminationController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\CommunicateController;
use App\Http\Controllers\Admin\FeesCollectionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[AuthController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'AuthLogin'])->name('authlogin');
Route::get('/logout',[AuthController::class,'logOut'])->name('logout');
Route::get('/forgot',[AuthController::class,'forgot'])->name('forgot');
Route::post('/check',[AuthController::class,'checkForgot'])->name('checkforgot');
Route::get('/reset/{token}',[AuthController::class,'reset'])->name('reset');
Route::post('/reset/{token}',[AuthController::class,'postReset'])->name('postReset');

// admin routes
Route::name('chat.')
    ->middleware('common')
    ->group(function () {
         Route::get('chat', [ChatController::class, 'chat'])->name('list');
         Route::post('submit_message', [ChatController::class, 'submit'])->name('submit_message');
         Route::post('get_chat_window', [ChatController::class, 'get_chat_window'])->name('get_chat_window');
         Route::post('get_chat_search_user', [ChatController::class, 'get_chat_search_user'])->name('get_chat_search_user');

    });


// admin routes
Route::name('admins.')
    ->middleware('admin')
    ->group(function () {
        Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Quản trị viên
        Route::get('/admin/admin/list',[AdminController::class, 'index'])->name('admin.list');
        Route::get('/admin/admin/create',[AdminController::class, 'create'])->name('admin.create');
        Route::post('/admin/admin/store',[AdminController::class, 'store'])->name('admin.store');
        Route::get('/admin/admin/edit/{id}',[AdminController::class, 'edit'])->name('admin.edit');
        Route::post('/admin/admin/update',[AdminController::class, 'update'])->name('admin.update');
    Route::get('/admin/admin/delete/{id}',[AdminController::class, 'delete'])->name('admin.delete');

    // Giáo Viên
        Route::get('/admin/teacher/list',[TeacherController::class, 'index'])->name('teacher.list');
        Route::get('/admin/teacher/create',[TeacherController::class, 'create'])->name('teacher.create');
        Route::post('/admin/teacher/store',[TeacherController::class, 'store'])->name('teacher.store');
        Route::get('/admin/teacher/edit/{id}',[TeacherController::class, 'edit'])->name('teacher.edit');
         Route::post('/admin/teacher/update',[TeacherController::class, 'update'])->name('teacher.update');
        Route::get('/admin/teacher/delete/{id}',[TeacherController::class, 'delete'])->name('teacher.delete');
        Route::post('admin/teacher/change_avatar', [TeacherProfileController::class,'changeAvatar'])->name('teacher.change_avatar');

        // Lớp học
        Route::get('/admin/class/list',[ClassController::class, 'index'])->name('class.list');
        Route::get('/admin/class/create',[ClassController::class, 'create'])->name('class.create');
        Route::post('/admin/class/store',[ClassController::class, 'store'])->name('class.store');
        Route::get('/admin/class/edit/{id}',[ClassController::class, 'edit'])->name('class.edit');
        Route::post('/admin/class/update',[ClassController::class, 'update'])->name('class.update');
        Route::get('/admin/class/delete/{id}',[ClassController::class, 'delete'])->name('class.delete');

        // Môn học
        Route::get('/admin/subject/list',[SubjectController::class, 'index'])->name('subject.list');
        Route::get('/admin/subject/create',[SubjectController::class, 'create'])->name('subject.create');
        Route::post('/admin/subject/store',[SubjectController::class, 'store'])->name('subject.store');
        Route::get('/admin/subject/edit/{id}',[SubjectController::class, 'edit'])->name('subject.edit');
        Route::post('/admin/subject/update',[SubjectController::class, 'update'])->name('subject.update');
        Route::get('/admin/subject/delete/{id}',[SubjectController::class, 'delete'])->name('subject.delete');

        // Đăng ký môn học
        Route::get('/admin/assign_subject/list',[AssignSubjectController::class, 'index'])->name('assign_subject.list');
        Route::get('/admin/assign_subject/create',[AssignSubjectController::class, 'create'])->name('assign_subject.create');
        Route::post('/admin/assign_subject/store',[AssignSubjectController::class, 'store'])->name('assign_subject.store');
        Route::get('/admin/assign_subject/edit/{id}',[AssignSubjectController::class, 'edit'])->name('assign_subject.edit');
        Route::post('/admin/assign_subject/update',[AssignSubjectController::class, 'update'])->name('assign_subject.update');
        Route::get('/admin/assign_subject/delete/{id}',[AssignSubjectController::class, 'delete'])->name('assign_subject.delete');

        // Đăng ký lịch học
        Route::get('/admin/class_timetable/list',[ClassTimeController::class, 'index'])->name('class_timetable.list');
        Route::post('/admin/class_timetable/get_subject',[ClassTimeController::class, 'getSubject'])->name('class_timetable.create');
        Route::post('/admin/class_timetable/store',[ClassTimeController::class, 'store'])->name('class_timetable.store');
        // Route::get('/admin/class_timetable/edit/{id}',[ClassTimeController::class, 'edit'])->name('class_timetable.edit');
        // Route::post('/admin/class_timetable/update',[ClassTimeController::class, 'update'])->name('class_timetable.update');
        Route::get('/admin/class_timetable/delete-all/{class_id}&{subject_id}',[ClassTimeController::class, 'deleteAll'])->name('class_timetable.delete_all');
        Route::get('/admin/class_timetable/delete/{class_id}&{subject_id}&{week_id}',[ClassTimeController::class, 'delete'])->name('class_timetable.delete');

        // Giáo viên chủ nhiệm
        Route::get('/admin/class_teacher/list',[ClassTeacherController::class, 'index'])->name('class_teacher.list');
        Route::get('/admin/class_teacher/create',[ClassTeacherController::class, 'create'])->name('class_teacher.create');
        Route::post('/admin/class_teacher/store',[ClassTeacherController::class, 'store'])->name('class_teacher.store');
        Route::get('/admin/class_teacher/edit/{id}',[ClassTeacherController::class, 'edit'])->name('class_teacher.edit');
        Route::post('/admin/class_teacher/update',[ClassTeacherController::class, 'update'])->name('class_teacher.update');
        Route::get('/admin/class_teacher/delete/{id}',[ClassTeacherController::class, 'delete'])->name('class_teacher.delete');

         // Học sinh
        Route::get('/admin/student/list',[StudentController::class, 'index'])->name('student.list');
        Route::get('/admin/student/create',[StudentController::class, 'create'])->name('student.create');
        Route::post('/admin/student/store',[StudentController::class, 'store'])->name('student.store');
        Route::get('/admin/student/edit/{id}',[StudentController::class, 'edit'])->name('student.edit');
         Route::post('/admin/student/update',[StudentController::class, 'update'])->name('student.update');
        Route::get('/admin/student/delete/{id}',[StudentController::class, 'delete'])->name('student.delete');
        Route::post('admin/student/change_avatar', [StudentController::class,'changeAvatarStudent'])->name('student.change_avatar');

        // phụ huynh
        Route::get('/admin/parent/list',[ParentController::class, 'index'])->name('parent.list');
        Route::get('/admin/parent/create',[ParentController::class, 'create'])->name('parent.create');
        Route::post('/admin/parent/store',[ParentController::class, 'store'])->name('parent.store');
        Route::get('/admin/parent/edit/{id}',[ParentController::class, 'edit'])->name('parent.edit');
        Route::post('/admin/parent/update',[ParentController::class, 'update'])->name('parent.update');
        Route::get('/admin/parent/delete/{id}',[ParentController::class, 'delete'])->name('parent.delete');
        Route::get('/admin/parent/my-student/{id}',[ParentController::class, 'myStudent'])->name('parent.my-student');
        Route::get('/admin/parent/assign_student/{parent_id}/{student_id}',[ParentController::class, 'assignStudent'])->name('parent.assign-student');
    Route::get('/admin/parent/not-my-student/{id}',[ParentController::class, 'notMyStudent'])->name('parent.not-my-student');

        // Kì thi
        Route::get('examinations/exam/list',[ExaminationController::class, 'index'])->name('examinations.exam.list');
        Route::get('examinations/exam/create',[ExaminationController::class, 'create'])->name('examinations.exam.create');
        Route::post('examinations/exam/store',[ExaminationController::class, 'store'])->name('examinations.exam.store');
        Route::get('examinations/exam/edit/{id}',[ExaminationController::class, 'edit'])->name('examinations.exam.edit');
        Route::post('examinations/exam/update',[ExaminationController::class, 'update'])->name('examinations.exam.update');
        Route::get('examinations/exam/delete/{id}',[ExaminationController::class, 'delete'])->name('examinations.exam.delete');

        // Đăng kí lịch thi
        Route::get('examinations/schedule',[ExaminationController::class, 'schedule'])->name('examinations.schedule');
        Route::post('examinations/schedule/store',[ExaminationController::class, 'scheduleStore'])->name('examinations.schedule.store');
        Route::get('examinations/schedule/delete-all/{exam_id}&{class_id}',[ExaminationController::class, 'scheduleDeleteAll'])->name('schedule.delete_all');
        Route::get('/examinations/schedule/delete/{exam_id}&{class_id}&{subject_id}',[ExaminationController::class, 'scheduleDelete'])->name('schedule.delete');

        // Đăng ký điểm thi
        Route::get('examinations/mark_register',[ExaminationController::class, 'mark_register'])->name('examinations.mark_register');
        Route::post('examinations/store_mark',[ExaminationController::class, 'store_mark'])->name('examinations.store_mark');
        Route::post('examinations/store_mark_single',[ExaminationController::class, 'store_mark_single'])->name('examinations.store_mark_single');

        // Điểm danh học sinh
        Route::get('attendance/student',[AttendanceController::class, 'attendanceStudent'])->name('attendance.student');
        Route::post('attendance/student/save',[AttendanceController::class, 'attendanceStudentSubmit'])->name('attendance.student_save');

        // repost
         Route::get('attendance/report',[AttendanceController::class, 'attendanceReport'])->name('attendance.report');

        // bảng thông báo
        Route::get('communicate/notice_board',[CommunicateController::class, 'list'])->name('communicate.list');
        Route::get('communicate/notice_board/create',[CommunicateController::class, 'create'])->name('communicate.create');
         Route::post('communicate/notice_board/store',[CommunicateController::class, 'store'])->name('communicate.store');
         Route::get('communicate/notice_board/edit/{id}',[CommunicateController::class, 'edit'])->name('communicate.edit');
        Route::post('communicate/notice_board/update',[CommunicateController::class, 'update'])->name('communicate.update');
        Route::get('communicate/notice_board/delete/{id}',[CommunicateController::class, 'delete'])->name('communicate.delete');


        // send email
        Route::get('communicate/send_email',[CommunicateController::class, 'sendEmail'])->name('communicate.send_email');
        Route::post('communicate/send_email_user',[CommunicateController::class, 'sendEmailUser'])->name('communicate.send_email_user');

          // học phí
        Route::get('fee_collection/collect_fee',[FeesCollectionController::class, 'index'])->name('fee_collection.collect_fee');
        Route::post('fee_collection/export_collect_fee',[FeesCollectionController::class, 'export_collect_fee'])->name('fee_collection.export_collect_fee');



        // cài đặt hệ thông
        Route::get('admin/setting',[AdminController::class, 'setting'])->name('setting');
        Route::post('admin/setting/update',[AdminController::class, 'Updatesetting'])->name('update_setting');




    });











// teacher routes
Route::name('teachers.')->middleware('teacher')->group(function () {

   Route::get('teacher/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // Profile
        Route::get('teacher/profile', [TeacherProfileController::class,'teacher'])->name('profile');
        Route::get('/teacher/profile/edit/{id}',[TeacherProfileController::class, 'editTeacher'])->name('profile.edit');
        Route::post('/teacher/profile/update',[TeacherProfileController::class, 'updateTeacher'])->name('profile.update');
        Route::post('teacher/profile/change_avatar', [TeacherProfileController::class,'changeAvatarTeacher'])->name('profile.change_avatar');
        Route::post('teacher/profile/change_password', [TeacherProfileController::class,'changePassTeacher'])->name('profile.change_password');

    // lớp giảng dạy
        Route::get('teacher/my_class_subject', [ClassTeacherController::class,'MyClassSubject'])->name('class-subject');
        Route::get('my_student/{class_id}', [ClassTeacherController::class,'MyStudent'])->name('my_student');

     // timetable
        Route::get('teacher/class_timetable/{class_id}&{subject_id}',[ClassTimeController::class, 'teacherTime'])->name('class_timetable');

        // exam time table
        Route::get('teacher/exam_timetable',[ExaminationController::class, 'MyExamTimeTableTeacher'])->name('exam_timetable');

        // calendar
        Route::get('teacher/calendar',[CalendarController::class, 'myCalendarTeacher'])->name('calendar');

         // Nhập điểm học phần
        Route::get('teacher/mark_register',[ExaminationController::class, 'mark_register_teacher'])->name('mark_register');
        Route::post('teacher/store_mark',[ExaminationController::class, 'store_mark'])->name('store_mark');
        Route::post('teacher/store_mark_single',[ExaminationController::class, 'store_mark_single'])->name('store_mark_single');

        // Điểm danh học sinh
        Route::get('teacher/student',[AttendanceController::class, 'attendanceStudentTeacher'])->name('attendance.student');
        Route::post('teacher/student/save',[AttendanceController::class, 'attendanceStudentSubmit'])->name('attendance.student_save');

        // repost
         Route::get('attendance/repost',[AttendanceController::class, 'attendanceReportTeacher'])->name('attendance.repost');

         // bảng thông báo
        Route::get('teacher/notice_board',[CommunicateController::class, 'myNoticeTeacher'])->name('notice_board');


});







// student routes
Route::name('students.')->middleware('student')->group(function () {
    Route::get('student/dashboard', [DashboardController::class,'index'])->name('dashboard');

        // Profile
        Route::get('student/profile', [StudentProfileController::class,'index'])->name('profile');
        Route::get('/studentv/profile/edit/{id}',[StudentProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/student/profile/update',[StudentProfileController::class, 'update'])->name('profile.update');
        Route::post('student/profile/change_avatar', [StudentProfileController::class,'changeAvatar'])->name('profile.change_avatar');
        Route::post('student/profile/change_password', [StudentProfileController::class,'changePass'])->name('profile.change_password');

        // my subject
   Route::get('student/my-subject', [SubjectController::class,'mySubject'])->name('my_subject');

        // timetable
        Route::get('/student/class_timetable',[ClassTimeController::class, 'myClassTime'])->name('class_timetable');

        // exam time table
        Route::get('student/exam_timetable',[ExaminationController::class, 'MyExamTimeTable'])->name('exam_timetable');

        // calendar
        Route::get('student/my_calendar',[CalendarController::class, 'MyCalendar'])->name('my_calendar');

        // exam result
        Route::get('student/exam_result',[ExaminationController::class, 'myExamResult'])->name('exam_result');


        // bảng thông báo
        Route::get('student/notice_board',[CommunicateController::class, 'myNoticeStudent'])->name('notice_board');

        // học phí
        Route::get('student/fee_collect',[FeesCollectionController::class, 'myFeeCollect'])->name('fee_collect');

        // thanh toán paypal

        Route::post('student/paypal',[FeesCollectionController::class, 'paypalStudent'])->name('paypal_student');

        Route::get('student/paypal/payment_error',[FeesCollectionController::class, 'paymentError'])->name('paypal_error');

        Route::get('student/paypal/payment_success',[FeesCollectionController::class, 'paymentSuccess'])->name('paypal_success');


});









// parent routes
Route::name('parents.')->middleware('parent')->group( function () {
    Route::get('parent/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // Profile
    Route::get('parent/profile', [ParentProfileController::class,'index'])->name('profile');
    Route::get('/parent/profile/edit/{id}',[ParentProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/parent/profile/update',[ParentProfileController::class, 'update'])->name('profile.update');
    Route::post('parent/profile/change_avatar', [ParentProfileController::class,'changeAvatar'])->name('profile.change_avatar');
    Route::post('parent/profile/change_password', [ParentProfileController::class,'changePass'])->name('profile.change_password');

    // my student

    Route::get('my-student/{id}',[ParentController::class, 'myStudentParent'])->name('my-student');
    Route::get('my-student/subject/{id}',[SubjectController::class, 'myStudentSubject'])->name('student.subject');
    Route::get('my-student/class_timetable/{class_id}&{subject_id}',[ClassTimeController::class, 'myStudentTime'])->name('class_timetable');

        // exam time table
        Route::get('my-student/subject/exam_timetable/{student_id}',[ExaminationController::class, 'MyStudentExamTimeTable'])->name('exam_timetable');

        // calendar
        Route::get('my-student/my_calendar/{student_id}',[CalendarController::class, 'myStudentCalendar'])->name('calendar');

        // calendar
        Route::get('exam_result/{student_id}',[ExaminationController::class, 'myStudentResult'])->name('exam_result');

        // bảng thông báo
        Route::get('parent/notice_board',[CommunicateController::class, 'myNoticeParent'])->name('notice_board');


});