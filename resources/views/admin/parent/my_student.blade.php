@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
<style>
    .avatar{
        width: 70px;
        height: 70px;
        object-fit: contain
    }
</style>

<div class="p-2">
    @include('message')
    <div class="card mb-3">
        <div class="card-header pb-0">
        <h6>Tìm kiếm sinh viên</h6>
        </div>
            <form action="" method="GET" class="mx-3 ">
                <div class="row">
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Tên</label>
                        <input type="text" name="name" class="form-control" placeholder="VD: Nguyễn Việt Hưng"
                        value="{{request()->name}}">
                    </div>
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="VD: example@gmail.com"
                        value="{{request()->email}}">
                    </div>
                    <div class="col-2">
                        <label for="example-text-input" class="form-control-label ">Mã sinh viên</label>
                        <input type="text" name="id_student" class="form-control" placeholder="VD: 22IT.B100"
                        value="{{request()->id_student}}">
                    </div>

                    <div class="col-2">
                        <label for="example-text-input" class="form-control-label ">Ngày sinh</label>
                        <input type="date" name="date_of_birth" class="form-control"
                        value="{{request()->date_of_birth}}"  min="01/01/2000" max="31/12/2023">
                    </div>
                    <div class="col-2">
                        <input type="text" class="opacity-0" >
                        <button type="submit" class="btn btn-primary btn-block">Tìm Kiếm</button>
                    </div>
                </div>
                </form>
    </div>
     @if (!empty($search_student))
         <div class='card mb-3'>
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                <h6>Sinh viên tìm kiếm</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sinh viên</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mã sinh viên</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">lớp</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày sinh</th>
                        <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($search_student as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://cvhrma.org/wp-content/uploads/2015/07/default-profile-photo.jpg" class="avatar avatar-sm me-3" alt="user1">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->user_name}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{$item->user_email}}</p>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0">{{$item->id_student}}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs text-secondary mb-0">{{$item->class_name}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$item->date_of_birth}}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('admins.parent.assign-student', ['parent_id'=>$parent_id, 'student_id' => $item->id])}}" class="text-primary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Không phải con tôi">
                                        <i class="fa-solid fa-user-graduate text-primary me-2" aria-hidden="true"></i></i>Đây là con tôi
                                        </a>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
     @endif
    <div class='card mb-3'>
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                <h6>Sinh viên của tôi</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sinh viên</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mã sinh viên</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">lớp</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày sinh</th>
                        <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($my_students as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="https://cvhrma.org/wp-content/uploads/2015/07/default-profile-photo.jpg" class="avatar avatar-sm me-3" alt="user1">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->user_name}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{$item->user_email}}</p>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0">{{$item->id_student}}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs text-secondary mb-0">{{$item->class_name}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$item->date_of_birth}}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('admins.parent.not-my-student', ['id'=>$item->id])}}" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Không phải con tôi">
                                        <i class="far fa-trash-alt me-2"></i>Không phải con tôi
                                        </a>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
