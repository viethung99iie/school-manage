
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
            <h6>Tìm kiếm thông báo</h6>
        </div>
        <div class="col-5 text-end">
                        <a class="btn bg-gradient-primary m-0 text-white" href="{{route('admins.communicate.create')}}">
                            <i class="fas fa-plus">
                            </i>&nbsp;&nbsp;Thông báo mới
                        </a>
        </div>
        </div>
        <form action="" method="GET" class="mx-3">
           <div class="row">
            <div class="col-3">
                 <label for="example-text-input" class="form-control-label ">Tiêu đề</label>
                <input type="text" name="title" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->title}}">
            </div>
            <div class="col-2">
               <label class="form-control-label ">Gửi tới</label>
               <select class="form-control" name='messto' >
                  <option value=""> Chọn</option>
                  <option value='2'{{request()->messto=='2'?'selected':''}}>Giảng viên</option>
                  <option value ='3' {{request()->messto=='3'?'selected':''}}>Sinh viên</option>
                  <option value ='4' {{request()->messto=='4'?'selected':''}}>Phụ huynh</option>
               </select>
            </div>
            <div class="col-2">
                 <label for="example-text-input" class="form-control-label ">Ngày thông báo </label>
                <input type="date" name="notice_date" class="form-control"
                value="{{request()->notice_date}}">
            </div>
             <div class="col-2">
                 <label for="example-text-input" class="form-control-label ">Ngày công khai</label>
                <input type="date" name="publish_date" class="form-control"
                value="{{request()->publish_date}}">
            </div>
            <div class="col-3">
                 <input type="text" class="opacity-0" >
                <button type="submit" class="btn btn-primary btn-block">Tìm Kiếm</button>
                <a href="{{route('admins.communicate.list')}}" class="btn btn-dribbble mx-2">Làm mới </a>
            </div>
           </div>
    </form>
</div>
  <div class='card mb-3'>
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <div class="col-7">
                        <h6>{{$title}}</h6>
                    </div>

                    </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-5">
                     <thead >
        <tr >
             <th width='10%' class="text-uppercase text-dark text-sm font-weight-bolder opacity-9">#</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Tiêu đề</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày thông báo</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày công khai </th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Gửi tới</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">tạo bởi</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Hàng động</th>
      </thead>
      <tbody>
        @foreach ($notice as $item)
            <tr>
                <td>
                    <h5 class="mb-0 text-dark text-sm">{{$item->id}}</h5>
                </td>
                <td>
                    <h5 class="mb-0 text-dark text-sm">{{$item->title}}</h5>
                </td>
                <td>
                    <h5 class="mb-0 text-dark text-sm">{{date('d-m-Y',strtotime($item->notice_date))}}</h5>
                </td>
                <td>
                    <h5 class="mb-0 text-dark text-sm">{{date('d-m-Y',strtotime($item->publish_date))}}</h5>
                </td>
                <td>

                    @foreach ($item->getMessage as $value)
                    @if ($value->mess_to == 2)
                       <h5 class="mb-0 text-dark text-sm"> Giảng viên</h5>
                    @elseif ($value->mess_to == 3)
                        <h5 class="mb-0 text-dark text-sm"> Sinh viên</h5>
                    @else
                        <h5 class="mb-0 text-dark text-sm"> Phụ huynh</h5>
                    @endif
                    @endforeach

                </td>
                <td>
                    <h5 class="mb-0 text-dark text-sm">{{$item->create_by}}</h5>
                </td>
                <td class="align-middle">
            <div class="ms-auto text-start">
                {{-- xóa --}}
                <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{ route('admins.communicate.delete', ['id'=>$item->id])}}">
                    <i class="far fa-trash-alt me-2"></i>Xóa
                </a>
                {{-- sửa --}}
                <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('admins.communicate.edit', ['id'=>$item->id])}}">
                    <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa
                </a>
            </div>
            </td>
            </tr>
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
