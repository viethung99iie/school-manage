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
            <h6>Tìm kiếm phụ huynh</h6>
        </div>
        <div class="col-5 text-end">
             <a class="btn bg-gradient-primary mb-0 text-white" href="{{route('admins.parent.create')}}">
                <i class="fas fa-plus">
                </i>&nbsp;&nbsp;Thêm phụ huynh
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
            <th  class=" text-dark text-xs font-weight-bolder opacity-9">Phụ huynh</th>
             <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Địa chỉ</th>
             <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày sinh</th>
             <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Giới tính</th>
          <th class=" text-dark text-sm font-weight-bolder opacity-9 ps-2"></th>
        </tr>
      </thead>
      <tbody>
         @foreach ($parents as $item)
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
            <span class="badge badge-dot me-2 text-secondary ">
              {{$item->address}}
            </span>
          </td>
          <td>
            <span class="badge badge-dot me-2">
              <span class="text-secondary ">{{$item->date_of_birth}}</span>
            </span>
          </td>
          <td>
            <span class="badge badge-dot me-2">
              <span class="text-secondary text-xs">{{$item->gender}}</span>
            </span>
          </td>
          <td class="align-middle">
            <div class="ms-auto text-start">
                {{-- con của tôi --}}
                <a class="btn btn-link text-primary px-1 mb-0" href="{{ route('admins.parent.my-student', ['id'=>$item->id])}}">
                    <i class="fa-solid fa-user-graduate text-primary me-2" aria-hidden="true"></i>Con của tôi
                </a>
                {{-- xóa --}}
                <a class="btn btn-link text-danger text-gradient px-1 mb-0" href="{{ route('admins.parent.delete', ['id'=>$item->user_id])}}">
                    <i class="far fa-trash-alt me-2"></i>Xóa
                </a>
                 {{-- sửa --}}
                <a class="btn btn-link text-dark px-1 mb-0" href="{{ route('admins.parent.edit', ['id'=>$item->id])}}">
                    <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa
                </a>
                <a class="btn btn-link text-primary px-3 mb-0" href="{{url('chat?user_type=4&receiver_id='.$item->id)}}"><i class="ni ni-chat-round text-primary me-2" aria-hidden="true"></i>Gửi tin nhắn</a>
            </div>
        </tr>
        @endforeach
      </tbody>
    </table>
                </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-center text-white">{{$parents->links()}}</div>
                </div>
            </div>
            </div>
        </div>
    </div>
   </div>


@endsection

