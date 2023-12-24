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
    <div class="card-header pb-0 d-flex">
        <div class="col-7">
            <h6>Tìm kiếm sinh viên</h6>
        </div>
        <div class="col-5 text-end">
            <a class="btn bg-gradient-primary m-0 text-white" href="{{route('admins.student.create')}}">
                <i class="fas fa-plus">
                </i>&nbsp;&nbsp;Thêm sinh viên
            </a>
        </div>
    </div>
    <form action="" method="GET" class="mx-3">
           <div class="row">
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label">Tên</label>
                <input type="text" name="name" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->name}}">
            </div>
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->email}}">
            </div>
            <div class="col-2">
                 <label for="example-text-input" class="form-control-label ">Mã sinh viên</label>
                <input type="text" name="student_id" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->student_id}}">
            </div>
            <div class="col-2">
                 <label for="example-text-input" class="form-control-label ">Lớp</label>
                <input type="text" name="class" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->class}}">
            </div>

           </div>
           <div class="row">
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label ">Ngày sinh</label>
                <input type="date" name="date_of_birth" class="form-control"
                value="{{request()->date_of_birth}}"  min="01/01/2000" max="31/12/2023">
            </div>
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label ">Ngày nhập học</label>
                <input type="date" name="date_admission" class="form-control"
                value="{{request()->date_admission}}">
            </div>
            <div class="col-3">
                 <input type="text" class="opacity-0" >
                <button type="submit" class="btn btn-primary btn-block">Tìm Kiếm</button>
            </div>
           </div>
    </form>
</div>
  <div class='card mb-3'>
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                <h6>{{$title}}</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 ">
      <thead >
        <tr>
          <th  class=" text-dark text-xs font-weight-bolder opacity-9">Sinh Viên</th>
           <th  class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">MSV</th>
            <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Lớp</th>
             <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Giới tính</th>
             <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày nhập học</th>
          <th class="text-dark  font-weight-bolder opacity-9 ps-2">Hành động</th>
        </tr>
      </thead>
      <tbody>
         @foreach ($students as $item)
            <tr>
            <td>
                <div class="d-flex px-2 py-1">
                <div>
                     @if ($item->user_avatar!=null)
                        <img src="{{ asset('image/'.$item->user_avatar) }}" class="avatar avatar-sm me-3" alt="user1">
                    @else
                        <img src="{{ asset('image/default.png') }}" class="avatar avatar-sm me-3" alt="user1">
                    @endif
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 ">{{$item->user_name}}</h6>
                    <p class="text-xs text-secondary mb-0">{{$item->user_email}}</p>
                </div>
                </div>
            </td>
          <td >
            <span class="badge badge-dot me-2">
              <span class="text-secondary text-xs">{{$item->id_student}}</span>
            </span>
          </td>
          <td>
            <span class="badge badge-dot me-2">
              <span class="text-secondary text-xs">{{$item->class_name}}</span>
            </span>
          </td>
          <td>
            <span class="badge badge-dot me-2">
              <span class="text-secondary text-xs">{{$item->gender}}</span>
            </span>
          </td>

          <td class="align-middle text-center">
            <div class="d-flex align-items-center">
              <span class=" text-secondary me-2 ">{{$item->date_admission}}</span>
            </div>
          </td>

          <td class="align-middle">
            <div class="ms-auto text-start">
                {{-- xóa --}}
                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{ route('admins.student.delete', ['id'=>$item->id])}}">
                    <i class="far fa-trash-alt me-2"></i>Xóa
                </a>
                {{-- sửa --}}
                <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('admins.student.edit', ['id'=>$item->id])}}">
                    <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa
                </a>
                <a class="btn btn-link text-primary px-3 mb-0" href="{{url('chat?user_type=3&receiver_id='.$item->id)}}"><i class="ni ni-chat-round text-primary me-2" aria-hidden="true"></i>Gửi tin nhắn</a>
            </div>
        </tr>
        @endforeach
      </tbody>
    </table>
                </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-center text-white">{{$students->links()}}</div>
                </div>
            </div>
            </div>
        </div>
    </div>
   </div>
@endsection
