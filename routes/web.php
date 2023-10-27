<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignSubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
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

        // phụ huynh
        Route::get('/admin/parent/list',[ParentController::class, 'index'])->name('parent.list');
        Route::get('/admin/parent/create',[ParentController::class, 'create'])->name('parent.create');
        Route::post('/admin/parent/store',[ParentController::class, 'store'])->name('parent.store');
        Route::get('/admin/parent/edit/{id}',[ParentController::class, 'edit'])->name('parent.edit');
        Route::post('/admin/parent/update',[ParentController::class, 'update'])->name('parent.update');
        Route::get('/admin/parent/delete/{id}',[ParentController::class, 'delete'])->name('parent.delete');


    });
// teacher routes
Route::name('teachers.')->middleware('teacher')->group(function () {
   Route::get('teacher/dashboard', [DashboardController::class,'index'])->name('dashboard');
});
// student routes
Route::name('students.')->middleware('student')->group(function () {
 Route::get('student/dashboard', [DashboardController::class,'index'])->name('dashboard');
});

// parent routes
Route::name('parents.')->middleware('parent')->group( function () {
  Route::get('parent/dashboard', [DashboardController::class,'index'])->name('dashboard');
});
