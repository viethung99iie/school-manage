@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')


<div class="p-2">
    @include('message')

<div class="card mb-3">
        <div class="card-header pb-0 d-flex">
        <div class="col-7">
            <h6>Tìm kiếm quản trị viên</h6>
        </div>
        <div class="col-5 text-end">
            <a class="btn bg-gradient-primary m-0 text-white" href="{{route('admins.admin.create')}}">
                <i class="fas fa-plus">
                </i>&nbsp;&nbsp;quản trị viên
            </a>
        </div>
        </div>
        <form action="" method="GET" class="mx-3">
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
                 <label for="example-text-input" class="form-control-label text-sm">Ngày tạo</label>
                <input type="date" name="date" class="form-control"
                value="{{request()->date}}">
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
            <div class=" mb-4">
                <div class="card-header pb-0">
                <h6>{{$title}}</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-5">
                     <thead >
        <tr >
            <th width='10%' class="text-uppercase text-dark text-sm font-weight-bolder opacity-9">#</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Tên</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Email</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày tạo</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Hàng động</th>
      </thead>
      <tbody>
         @foreach ($admins as $admin)
            <tr>
          <td>
            <div class="d-flex px-2">
              <div class="my-auto">
                <h5 class="mb-0 text-sm">{{$admin->id}}</h5>
              </div>
            </div>
          </td>
          <td>
            <h5 class="mb-0 text-dark text-sm">{{$admin->name}}</h5>
          </td>
          <td>
            <h5 class="mb-0 text-dark text-sm">{{$admin->email}}</h5>
          </td>
          <td class="align-middle text-center">
            <div class="d-flex align-items-center">
              <span class="me-2 text-sm">{{$admin->created_at}}</span>
            </div>
          </td>

          <td >
                 <div class="ms-auto text-start">
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{ route('admins.admin.delete', ['id'=>$admin->id])}}"><i class="far fa-trash-alt me-2"></i>Xóa</a>
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('admins.admin.edit', ['id'=>$admin->id])}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa</a>
                    <a class="btn btn-link text-primary px-3 mb-0" href="{{url('chat?receiver_id='.$admin->id)}}"><i class="ni ni-chat-round text-primary me-2" aria-hidden="true"></i>Gửi tin nhắn</a>
                  </div>
          </td>
        </tr>
        @endforeach
      </tbody>
        </table>
                </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-center text-white">{{$admins->links()}}</div>
                </div>
            </div>
            </div>
        </div>
    </div>
   </div>
@endsection
