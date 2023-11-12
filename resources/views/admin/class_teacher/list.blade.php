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
            <h6>Tìm kiếm lớp học đã có giáo viên chủ nhiệm</h6>
         </div>
         <div class="col-5 text-end">
            <a class="btn bg-gradient-primary m-0 text-white" href="{{route('admins.class_teacher.create')}}">
            <i class="fas fa-plus">
            </i>&nbsp;&nbsp;Đăng ký GVCN
            </a>
         </div>
      </div>
      <form action="" method="GET" class="mx-3 ">
         <div class="row">
            <div class="col-3">
               <label for="example-text-input" class="form-control-label ">Tên giảng viên</label>
               <input type="text" name="teacher" class="form-control" placeholder="VD: Nguyễn Việt Hưng"
                  value="{{request()->teacher}}">
            </div>
            <div class="col-3">
               <label for="example-text-input" class="form-control-label ">Tên lớp</label>
               <input type="text" name="class" class="form-control" placeholder="VD: 22GIT2"
                  value="{{request()->class}}">
            </div>
            <div class="col-2">
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
                  <h6>Danh sách </h6>
               </div>
               <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                     <table class="table table-responsive">
                        <thead >
                           <tr class="">
                              <th width='10%' class=" text-dark text-xs font-weight-bolder opacity-9">#</th>
                              <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Tên lớp</th>
                              <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Giáo viên chủ nhiệm</th>
                              <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Trạng thái</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày tạo</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Hành động</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($class as $item)
        @if (count($item->subjects)>0)
        <tr>
          <td>
            <div class="d-flex px-2">
              <div class="my-auto">
                <h5 class="mb-0 text-sm">{{$item->id}}</h5>
              </div>
            </div>
          </td>
          <td>
            <h5 class="mb-0 text-secondary text-sm">{{$item->name}}</h5>
          </td>
           <td>
            <span class="badge badge-dot text-lowercase text-limit text-sm text-secondary">
              ({{count($item->Teachers)}})
              @foreach ($item->Teachers as $key => $teacher)
                   {{ $teacher->name }}@if (!$loop->last),@endif
            @endforeach
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
                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{ route('admins.class_teacher.delete', ['id'=>$item->id])}}">
                    <i class="far fa-trash-alt me-2"></i>Xóa
                </a>
                {{-- sửa --}}
                <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('admins.class_teacher.edit', ['id'=>$item->id])}}">
                    <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa
                </a>
            </div>
        </tr>
        @endif
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
@section('javascript')
<script src="{{asset("assets/js/app.js")}}"></script>
@endsection
