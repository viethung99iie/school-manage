@extends('layouts.app')
@section('content')
<div class="card">

  <div class="table-responsive p-5">
        <div class="row d-flex justify-content-lg-end">
            <h3 >Danh sách lớp học</h3>

        </div>
        <div class="d-flex justify-content-end mx-5"> <a href="{{route('admins.class.create')}}" class="btn btn-facebook "> Thêm lớp học</a></div>
        @include('message')
    <form action="" method="GET" class="m-3">
           <div class="row">
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label text-sm">Tên</label>
                <input type="text" name="name" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->name}}">
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
    <table class="table align-items-center mb-0 ">
      <thead >
        <tr class="table-primary">
          <th width='10%' class="text-uppercase text-dark text-sm font-weight-bolder opacity-9">#</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Tên</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Tạo bởi</th>
            <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Trạng thái</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Ngày tạo</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Hành động</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($class as $item)
            <tr>
          <td>
            <div class="d-flex px-2">
              <div class="my-auto">
                <h5 class="mb-0 text-sm">{{$item->id}}</h5>
              </div>
            </div>
          </td>
          <td>
            <h5 class="mb-0 text-dark text-sm">{{$item->name}}</h5>
          </td>
          <td>
            <span class="badge badge-dot me-4">
              <i class="bg-info"></i>
              <span class="text-dark text-xs">{{$item->user_name}}</span>
            </span>
          </td>
          <td class="align-middle text-center">
            <div class="d-flex align-items-center">
              <span class="me-2 text-sm">{!!$item->status==0?'<button class="btn btn-success">Đang hoạt động</button>':'<button class="btn btn-dribbble">Đang ẩn</button>'!!}</span>
            </div>
          </td>
          <td class="align-middle text-center">
            <div class="d-flex align-items-center">
              <span class="me-2 text-sm">{{$item->created_at}}</span>
            </div>
          </td>

          <td class="align-middle">
            <div class="row d-flex ">
                <a href="{{ route('admins.class.edit', ['id'=>$item->id])}}" class="btn btn-primary w-50 mr-1">Sửa</a>
                <a href="{{ route('admins.class.delete', ['id'=>$item->id])}}" class="btn btn-danger w-50 ">Xóa</a>
            </div>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="row">
    <div class="d-flex justify-content-center text-white">{{$class->links()}}</div>
</div>
  </div>
   </div>
@endsection
