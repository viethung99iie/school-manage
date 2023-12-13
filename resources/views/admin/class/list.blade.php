@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
    @include('message')
<div class="p-2">
    <div class="card mb-3">
        <div class="card-header pb-0 d-flex">
        <div class="col-7">
            <h6>Tìm kiếm lớp</h6>
        </div>
        <div class="col-5 text-end">
            <a class="btn bg-gradient-primary mb-0 text-white" href="{{route('admins.class.create')}}">
                <i class="fas fa-plus">
                </i>&nbsp;&nbsp;Thêm lớp
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
            <div class="card mb-4">
                <div class="card-header pb-0">
                <h6>{{$title}}</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-5">
                     <thead >
        <tr >
            <th width='10%' class="text-uppercase text-dark text-sm font-weight-bolder opacity-9">#</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Tên</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Học phí</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Tạo bởi</th>
            <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Trạng thái</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Ngày tạo</th>
          <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Hành động</th>
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
            <h5 class="mb-0 text-dark text-sm">{{number_format($item->amount,0)}} VNĐ</h5>
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
            <div class="ms-auto text-start">
                {{-- xóa --}}
                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{ route('admins.class.delete', ['id'=>$item->id])}}">
                    <i class="far fa-trash-alt me-2"></i>Xóa
                </a>
                {{-- sửa --}}
                <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('admins.class.edit', ['id'=>$item->id])}}">
                    <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa
                </a>
            </div>
        </tr>
        @endforeach
      </tbody>
        </table>
                </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-center text-white">{{$class->links()}}</div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
