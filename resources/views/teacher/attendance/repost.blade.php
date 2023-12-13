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
            <h6>Tìm kiếm</h6>
         </div>
      </div>
      <form action="" method="GET" class="mx-3 ">
         <div class="row">
            <div class="col-2">
                 <label for="example-text-input" class="form-control-label">Mã sinh viên</label>
                <input type="text" name="id_student" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->id_student}}">
            </div>
            <div class="col-2">
                 <label for="example-text-input" class="form-control-label">Tên</label>
                <input type="text" name="name" class="form-control" placeholder="Từ khóa tìm kiếm..."
                value="{{request()->name}}">
            </div>
            <div class="col-2">
               <label for="example-text-input" class="form-control-label ">Lớp</label>
               <select name="class_id" id='getClass' class='form-control getSubject' id="">
                  <option value="">Chọn</option>
                  @foreach ($class as $item)
                  <option value='{{$item->class_id}}' {{Request::get('class_id')==$item->class_id?'selected':''}}>{{$item->class_name}}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-2">
               <label for="example-text-input" class="form-control-label ">Ngày học</label>
               <input type="date" name="attendance" id='getAttendance' class="form-control" value="{{!empty(Request::get('attendance'))?Request::get('attendance'):''}}" required>
            </div>
            <div class="col-1">
               <label for="example-text-input" class="form-control-label ">Thể loại</label>
               <select class="form-control" name='attendance_type'>
                        <option value=''>chọn</option>
                        <option value='2' {{Request::get('attendance_type')=='2'?'selected':''}}>Vắng</option>
                        <option value='3' {{Request::get('attendance_type')=='3'?'selected':''}}>Trễ</option>
                        <option value='4' {{Request::get('attendance_type')=='4'?'selected':''}}>Nghỉ có phép</option>
                    </select>
            </div>
            <div class="col-3">
               <input type="text" class="opacity-0" >
               <div class="d-flex">
                  <button type="submit" class="btn btn-primary ">Tìm Kiếm</button>
                  <a href="{{route('teachers.attendance.repost')}}" class="btn btn-dribbble mx-2">Làm mới </a>
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
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Lớp</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm danh</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày điểm danh</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2"></th>
                        </thead>
                        <tbody>
                            @forelse ($getRecord as $item)
                            @php
                                $attendance_type = '';
                                if($item->attendance_type==2){
                                    $attendance_type = 'Vắng';
                                }elseif($item->attendance_type==3){
                                        $attendance_type = 'Trễ';
                                }else{
                                        $attendance_type = 'Vắng có phép';
                                }
                            @endphp
                            <tr>
                                <td>
                                        <h5 class="mx-2 mb-0 text-dark text-sm">{{$item->id_student}}</h5>
                                </td>
                                <td>
                                        <h5 class="mx-2 mb-0 text-dark text-sm">{{$item->student_name}}</h5>
                                </td>
                                <td>
                                        <h5 class="mx-2 mb-0 text-dark text-sm">{{$item->class_name}}</h5>
                                </td>
                                <td>
                                        <h5 class="mx-2 mb-0 text-dark text-sm">{{$attendance_type}}</h5>
                                </td>
                                <td>
                                        <h5 class="mx-2 mb-0 text-dark text-sm">{{$item->attendance_date}}</h5>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="100%">Không tìm thấy kết quả</td>
                                </tr>
                            @endforelse
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
