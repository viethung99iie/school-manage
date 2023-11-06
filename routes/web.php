<?php


use App\Http\Controllers\Admin\AssignSubjectController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\User\Teacher\ProfileController as TeacherProfileController;
use App\Http\Controllers\User\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\User\Parent\ProfileController as ParentProfileController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\AuthController;
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
        Route::post('admin/teacher/change_avatar', [ProfileController::class,'changeAvatar'])->name('teacher.change_avatar');

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

});