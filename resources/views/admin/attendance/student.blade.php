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
            <h6>{{$title}}</h6>
        </div>
        </div>
            <form action="" method="GET" class="mx-3 ">
            <div class="row">
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Lớp</label>
                       <select name="class_id" id='getClass' class='form-control getSubject' id="">
                        <option value="">Chọn</option>
                            @foreach ($class as $item)
                                <option value='{{$item['id']}}' {{Request::get('class_id')==$item['id']?'selected':''}}>{{$item['name']}}</option>
                            @endforeach
                       </select>
                    </div>
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Ngày học</label>
                       <input type="date" name="attendance" id='getAttendance' class="form-control" value="{{!empty(Request::get('attendance'))?Request::get('attendance'):''}}" required>
                    </div>
                    <div class="col-5">
                        <input type="text" class="opacity-0" >
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ">Tìm Kiếm</button>
                            <a href="{{route('admins.attendance.student')}}" class="btn btn-dribbble mx-2">Làm mới </a>
                        </div>
                        </div>
        </div>
                </form>
    </div>
    @if (!empty(Request::get('class_id'))&& !empty(Request::get('attendance')))
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
          <th class="text-dark text-xs font-weight-bolder opacity-9 ">Mã sinh viên</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Tên</th>
          <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm danh</th>
      </thead>
      <tbody>
         @foreach ($students as $item)
         @php
            $attendance_type = '1';
            $getAttendance = $item->getAttendance($item->id,Request::get('class_id'),Request::get('attendance'));
            if(!empty($getAttendance)){
                $attendance_type = $getAttendance->attendance_type;
            }
         @endphp
            <tr>
          <td>
            <div class="d-flex px-4">
                <h5 class="mb-0 text-sm">{{$item->id_student}}</h5>
            </div>
          </td>
          <td>
            <h5 class="mb-0 text-dark text-sm">{{$item->user_name}}</h5>
          </td>
          <td>
            <label class="form-check-label mx-2">
                <input type="radio" value="1" {{$attendance_type=='1'?'checked':''}} name="attendance{{$item->id}}" class="saveAttendance" id="{{$item->id}}">
                  Có mặt
            </label>
            <label class="form-check-label mx-2">
                <input type="radio" value="2" {{$attendance_type=='2'?'checked':''}} name="attendance{{$item->id}}" class="saveAttendance" id="{{$item->id}}">
                 Vắng
                </label>
            <label class="form-check-label mx-2">
                <input type="radio" value="3" {{$attendance_type=='3'?'checked':''}} name="attendance{{$item->id}}" class="saveAttendance" id="{{$item->id}}">
                 Trễ
                </label>
            <label class="form-check-label">
                <input type="radio" value="4" {{$attendance_type=='4'?'checked':''}} name="attendance{{$item->id}}" class="saveAttendance" id="{{$item->id}}">
                Nghỉ có phép
            </label>

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
    @endif
   </div>
@endsection
@section('javascript')
<script>
    $('.saveAttendance').change(function(e){
        var student_id = $(this).attr('id');
        var attendance_type = $(this).val();
        var class_id = $('#getClass').val();
        var attendance_date = $('#getAttendance').val();
        $.ajax({
            type: 'Post',
            url: "{{route('admins.attendance.student_save')}}",
            data: {
                "_token": "{{csrf_token()}}" ,
                student_id: student_id,
                attendance_type: attendance_type,
                class_id: class_id,
                attendance_date: attendance_date,

            },
            dataType: 'json',
            success: function(data){
                alert(data.message);
            }
        });
    })
</script>
@endsection
