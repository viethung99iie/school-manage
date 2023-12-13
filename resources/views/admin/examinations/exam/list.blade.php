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
            <h6>Tìm kiếm kì thi</h6>
        </div>
        <div class="col-5 text-end">
            <a class="btn bg-gradient-primary m-0 text-white" href="{{route('admins.examinations.exam.create')}}">
                <i class="fas fa-plus">
                </i>&nbsp;&nbsp;Thêm kì thi
            </a>
        </div>
        </div>
        <form action="" method="GET" class="mx-3">
           <div class="row">
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label text-sm">Tên kì thi</label>
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
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary btn-block">Tìm Kiếm</button>
                <a href="{{route('admins.examinations.exam.list')}}" class="btn btn-dribbble mx-2">Làm mới </a>
                </div>
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
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Tên</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ghi chú</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Tạo bởi</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày tạo</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Hàng động</th>
      </thead>
      <tbody>
         @foreach ($exams as $item)
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
            <h5 class="mb-0 text-dark text-sm">{!!$item->note!!}</h5>
          </td>
          <td class="align-middle text-center">
            <div class="d-flex align-items-center">
              <span class="me-2 text-sm">{{$item->user_name}}</span>
            </div>
          </td>
          <td class="align-middle text-center">
            <div class="d-flex align-items-center">
              <span class="me-2 text-sm">{{$item->created_at}}</span>
            </div>
          </td>
          <td >
                 <div class="ms-auto text-start">
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{ route('admins.examinations.exam.delete', ['id'=>$item->id])}}"><i class="far fa-trash-alt me-2"></i>Xóa</a>
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('admins.examinations.exam.edit', ['id'=>$item->id])}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa</a>
                  </div>
          </td>
        </tr>
        @endforeach
      </tbody>
        </table>
                </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-center text-white">{{$exams->links()}}</div>
                </div>
            </div>
            </div>
        </div>
    </div>
   </div>
@endsection
