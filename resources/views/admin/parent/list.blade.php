@extends('layouts.app')
@section('content')
<style>
    .avatar{
        width: 70px;
        height: 70px;
        object-fit: contain
    }
</style>

<div class="card">

  <div class="table-responsive p-5">
        <div class="row d-flex justify-content-lg-end">
            <h3 >{{$title}}</h3>
        </div>
        <div class="d-flex justify-content-end mx-5"> <a href="{{route('admins.parent.create')}}" class="btn btn-facebook "> Thêm học sinh</a></div>
           @include('message')
    <form action="" method="GET" class="m-3">
           <div class="row">
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label text-sm">Tên</label>
                <input type="text" name="name" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->name}}">
            </div>
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label text-sm">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->email}}">
            </div>
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label text-sm">Ngày sinh</label>
                <input type="date" name="date_of_birth" class="form-control"
                value="{{request()->date_of_birth}}"  min="01/01/2000" max="31/12/2023">
            </div>
           </div>
           <div class="row">
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label text-sm">Mã sinh viên</label>
                <input type="text" name="parent_id" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->parent_id}}">
            </div>
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label text-sm">Lớp</label>
                <input type="text" name="class" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->class}}">
            </div>
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label text-sm">Ngày nhập học</label>
                <input type="date" name="date_admission" class="form-control"
                value="{{request()->date_admission}}">
            </div>
            <div class="col-3">
                 <input type="text" class="opacity-0" >
                <button type="submit" class="btn btn-primary btn-block">Tìm Kiếm</button>
            </div>
           </div>
    </form>
    <div class="table-responsive">
            <table class="table align-items-center mb-0 ">
      <thead >
        <tr class="table-primary">
          <th  class="text-uppercase text-dark text-sm font-weight-bolder opacity-9">#</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Avatar</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Tên</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Email</th>
             <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Giới tính</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Hành động</th>
        </tr>
      </thead>
      <tbody>
         @foreach ($parents as $item)
            <tr>
          <td>
            <div class="d-flex px-2">
              <div class="my-auto">
                <h5 class="mb-0 text-sm">{{$item->id}}</h5>
              </div>
            </div>
          </td>
           <td>
            <h5 class="mb-0 text-dark text-sm"><img class='avatar' src="https://cvhrma.org/wp-content/uploads/2015/07/default-profile-photo.jpg" alt=""></h5>
          </td>
          <td>
            <h5 class="mb-0 text-dark text-sm">{{$item->user_name}}</h5>
          </td>
          <td>
            <span class="badge badge-dot me-2">
              <span class="text-dark text-xs">{{$item->user_email}}</span>
            </span>
          </td>
          <td>
            <span class="badge badge-dot me-2">
              <span class="text-dark text-xs">{{$item->gender}}</span>
            </span>
          </td>
          <td class="align-middle">
            <div class="row d-flex ">
                <a href="{{ route('admins.parent.edit', ['id'=>$item->id])}}" class="btn btn-primary w-50 mr-1">Sửa</a>
                <a href="{{ route('admins.parent.delete', ['id'=>$item->id])}}" class="btn btn-danger w-50 ">Xóa</a>
            </div>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    <div class="row">
    <div class="d-flex justify-content-center text-white">{{$parents->links()}}</div>
</div>
  </div>
   </div>
@endsection
