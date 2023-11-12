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
            <h6>Lớp học đăng ký</h6>
        </div>
        <div class="col-5 text-end">
            <a class="btn bg-gradient-primary m-0 text-white" href="{{route('admins.class_timetable.create')}}">
                <i class="fas fa-plus">
                </i>&nbsp;&nbsp;Thêm thời gian biểu
            </a>
        </div>
        </div>
            <form action="" method="GET" class="mx-3 ">
            <div class="row">
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label" >Lớp</label>
                         <select class="form-control getClass" name='class_id'>
                    <option >Chọn</option>
                    @foreach ($class as $item)
                    <option value='{{$item->id}}' {{Request::get('class_id')==$item->id?'selected':''}}>{{$item->name}}</option>
                    @endforeach
                </select>
                    </div>
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Môn học</label>
                       <select name="subject_id" class='form-control getSubject' id="">
                        <option value="">Chọn</option>
                        @if (Request::get('class_id'))
                            @foreach ($subjects as $item)
                                <option value='{{$item->subject_id}}' {{Request::get('subject_id')==$item->subject_id?'selected':''}}>{{$item->subject_name}}</option>
                            @endforeach
                        @endif
                       </select>
                    </div>
                    <div class="col-5">
                        <input type="text" class="opacity-0" >
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ">Tìm Kiếm</button>
                            <a href="{{route('admins.class_timetable.list')}}" class="btn btn-dribbble mx-2">Làm mới </a>
                        </div>
                        </div>
        </div>
                </form>
    </div>
    @if (!empty(Request::get('class_id') && Request::get('subject_id')))
        <div class='card mb-3'>
      <div class="row">
         <div class="col-12">
            <div class="card mb-4">
               <div class="card-header pb-0">
                  <h6>Thời khóa biểu</h6>
               </div>
               <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                    <form action="{{route('admins.class_timetable.store')}}" method="post">
                        @csrf
                     <table class="table table-responsive table-striped">
                         <input type="hidden" name='class_id' class="form-control" value='{{Request::get('class_id')}}'>
                          <input type="hidden" name='subject_id' class="form-control" value="{{Request::get('subject_id')}}">
                        <thead >
                           <tr class="">
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ">Ngày</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Thời gian bắt đầu</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">thời gian kết thúc</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Phòng học</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2"></th>
                           </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                  @foreach ($weeks as $item)

        <tr>
          <td>
             <input type="hidden" name='timetable[{{$i}}][week_id]' class="form-control" value="{{$item['week_id']}}">
            <h5 class="mb-0 text-dark text-sm px-4">{{$item['week_name']}}</h5>
          </td>
          <td>

            <input type="time" name='timetable[{{$i}}][start_time]' value="{{$item['start_time']}}" class="form-control">
          </td>
           <td>
            <input type="time" name='timetable[{{$i}}][end_time]' value="{{$item['end_time']}}" class="form-control">
          </td>
           <td style="width:250px;">
            <input type="text" name='timetable[{{$i}}][room]' value="{{$item['room']}}"  class="form-control">
          </td>
          <td>
            <a href="{{ route('admins.class_timetable.delete', ['class_id'=>Request::get('class_id'),'subject_id'=>Request::get('subject_id'),'week_id'=>$item['week_id']]) }}" class="btn btn-dribbble mx-2">Xóa</a>
          </td>
        </tr>
                @php
                    $i++;
                @endphp
        @endforeach
                        </tbody>
                     </table>
                     <div class="d-flex justify-content-center">
                        <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                        <a href="{{ route('admins.class_timetable.delete_all', ['class_id'=>Request::get('class_id'),'subject_id'=>Request::get('subject_id')]) }}" class="btn btn-dribbble mx-2">Xóa tất cả</a>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
    @endif
</div>
@endsection

@section('javascript')
<script type="text/javascript">
$('.getClass').change(function() {
    var class_id = $(this).val();
    console.log(class_id);
    $.ajax({
        url:"{{ url('/admin/class_timetable/get_subject')}}",
        type:"post",
        data:{
            "_token":"{{ csrf_token() }}",
            class_id:class_id,
        },
        dataType:"json",
        success:function(response){
            console.log(response.html);
            $('.getSubject').html(response.html);
        },
    });
    });
</script>


@endsection
