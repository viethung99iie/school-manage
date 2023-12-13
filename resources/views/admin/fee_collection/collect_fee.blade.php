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
            <h6>Tìm kiếm học phí của sinh viên</h6>
        </div>
        </div>
            <form action="" method="GET" class="m-3">
           <div class="row">
             <div class="col-2">
                 <label for="example-text-input" class="form-control-label ">Tên</label>
                <input type="text" name="name" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->name}}">
            </div>
            <div class="col-2">
                 <label for="example-text-input" class="form-control-label ">Mã sinh viên</label>
                <input type="text" name="id_student" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->id_student}}">
            </div>
            <div class="col-2">
                        <label for="example-text-input" class="form-control-label" >Lớp</label>
                         <select class="form-control getClass" name='class_id'>
                    <option  value="">Chọn</option>
                    @foreach ($class as $item)
                    <option value='{{$item->id}}' {{Request::get('class_id')==$item->id?'selected':''}}>{{$item->name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="col-2">
                    <label for="example-text-input" class="form-control-label" >Học kì</label>
                    <select class="form-control " name='exam_id'>
                <option value="">Chọn</option>
                @foreach ($exam as $item)
                <option value='{{$item->id}}' {{Request::get('exam_id')==$item->id?'selected':''}}>{{$item->name}}</option>
                @endforeach
            </select>
                </div>
                 <div class="col-2">
                 <label for="example-text-input" class="form-control-label ">Ngày bắt đầu </label>
                <input type="date" name="from_date" class="form-control" id='from_date'
                value="{{request()->from_date}}">
            </div>
             <div class="col-2">
                 <label for="example-text-input" class="form-control-label ">Ngày kết thúc</label>
                <input type="date" name="to_date" class="form-control" id='to_date'
                value="{{request()->to_date}}">
            </div>

           </div>
           <div class="row">

            <div class="col-3">
                 <input type="text" class="opacity-0" >
                <button type="submit" class="btn btn-primary btn-block">Tìm Kiếm</button>
                <a href="{{route('admins.fee_collection.collect_fee')}}" class="btn btn-dribbble mx-2">Làm mới </a>
            </div>
           </div>
    </form>
    </div>
    <div class='card mb-3'>
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                <h6>Danh sách sinh viên</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                     <table class="table align-items-center mb-0 ">
      <thead >
        <tr>
          <th  class=" text-dark text-xs font-weight-bolder opacity-9">Sinh Viên</th>
           <th  class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">MSV</th>
           <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Học kì</th>
            <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Lớp</th>
             <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Học phí</th>
             <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Trạng thái</th>
             <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày nộp</th>
        </tr>
      </thead>
      <tbody>
        @if ($getRecord->total() > 0)
            @foreach ($getRecord as $item)
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
              <span class="text-secondary text-xs">{{$item->exam_name}}</span>
            </span>
          </td>
          <td>
            <span class="badge badge-dot me-2">
              <span class="text-secondary text-xs">{{$item->class_name}}</span>
            </span>
          </td>
          <td>
            <span class="badge badge-dot me-2">
              <span class="text-secondary text-xs">{{number_format($item->class_amount,0)}} VNĐ</span>
            </span>
          </td>
          <td>
            <span class="badge badge-dot me-2">
                <span class="text-success text-xs">Đã thanh toán</span>
                                    </span>
          </td>

          <td class="align-middle text-center">
            <div class="d-flex align-items-center">
              <span class=" text-secondary me-2 ">{{date('d-m-Y',strtotime($item->created_at))}}</span>
            </div>
          </td>
        </tr>
        @endforeach
        @else
            <tr>
                <td colspan="100%">
                    <p class='text-center'>Không tìm thấy dữ liệu</p>
                </td>
            </tr>
        @endif
      </tbody>
    </table>
                </div>
                </div>
                {{-- <div class="row">
                    <div class="d-flex justify-content-center text-white">{{$class->links()}}</div>
                </div> --}}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
