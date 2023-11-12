@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('title')
{{$title}}
@endsection
@section('content')
<div class="card">
   <div class="table-responsive p-4">
      <div class="row d-flex justify-content-lg-end">
         <div class="col-8">
            <h2 class="text-center">Danh sách môn học</h2>
         </div>
         <div class="col-4 text-end">
            <a class="btn bg-gradient-primary mb-0 text-white" href="{{route('admins.subject.create')}}">
            <i class="fas fa-plus">
            </i>&nbsp;&nbsp;Thêm môn học
            </a>
         </div>
      </div>
      @include('message')
      <form action="" method="GET" class="m-3">
         <div class="row">
            <div class="col-3">
               <label  class="form-control-label text-sm">Tên môn học</label>
               <input type="text" name="name" class="form-control" placeholder="Từ khóa tìm kiếm..."
                  value="{{request()->name}}">
            </div>
            <div class="col-3">
               <label class="form-control-label text-sm">Thể loại</label>
               <select class="form-control" name='type' >
                  <option value="">-- Chọn thể loại  --</option>
                  <option value='Toán'{{request()->type=='Toán'?'selected':''}}>Toán</option>
                  <option value ='Lý' {{request()->type=='Lý'?'selected':''}}>Lý</option>
                  <option value ='Hóa' {{request()->type=='Hóa'?'selected':''}}>Hóa</option>
               </select>
            </div>
            <div class="col-3">
               <label  class="form-control-label text-sm">Ngày tạo</label>
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
               <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Thể loại</th>
               <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Tạo bởi</th>
               <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Trạng thái</th>
               <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Ngày tạo</th>
               <th class="text-uppercase text-dark text-sm font-weight-bolder opacity-9 ps-2">Hành động</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($subjects as $item)
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
                  <span class="text-dark text-xs">{{$item->type}}</span>
                  </span>
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
                     <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{ route('admins.subject.delete', ['id'=>$item->id])}}">
                     <i class="far fa-trash-alt me-2"></i>Xóa
                     </a>
                     {{-- sửa --}}
                     <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('admins.subject.edit', ['id'=>$item->id])}}">
                     <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa
                     </a>
                  </div>
            </tr>
            @endforeach
         </tbody>
      </table>
      <div class="row">
         <div class="d-flex justify-content-center text-white">{{$subjects->links()}}</div>
      </div>
   </div>
</div>
@endsection
