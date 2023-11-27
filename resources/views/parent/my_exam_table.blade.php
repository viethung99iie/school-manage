@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
@include('message')
<div class="p-2">
<div class="card p-2 my-2">
            <h4>Sinh Viên : {{$student_name}}</h4>
    </div>
   @foreach ($getRecord as $value )
   <div class='card mb-3'>
      <div class="row">
         <div class="col-12">
            <div class="card mb-4">
               <div class="card-header pb-0">

                  <h6>{{$value['name']}}</h6>

               </div>
               <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                     <table class="table table-responsive table-striped">
                        <thead >
                           <tr class="">
                              <th class="text-dark text-xs font-weight-bolder opacity-9">Môn học</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Thứ</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày thi</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Bắt Đầu</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Kết thúc</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Phòng thi</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm tối đa</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm liệt</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($value['exam'] as $item)
                           <tr>
                              <td>
                                 <div class="d-flex px-2">
                                    <div class="my-auto">
                                       <h5 class="mb-0 text-sm">{{$item['subject_name']}}</h5>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <input type="text" value="{{ date( 'l' ,
                                  strtotime($item['exam_date'])) }}" class="form-control" disabled>
                              </td>
                              <td>
                                 <input type="date" value="{{$item['exam_date']}}" class="form-control" disabled>
                              </td>
                              <td>
                                 <input type="time" value="{{$item['start_time']}}" class="form-control" disabled>
                              </td>
                              <td>
                                 <input type="time"value="{{$item['end_time']}}" class="form-control" disabled>
                              </td>
                              <td >
                                 <input type="text" value="{{$item['room']}}"  class="form-control" disabled>
                              </td>
                              <td >
                                 <input type="text" value="{{$item['full_mark']}}"  class="form-control" disabled>
                              </td>
                              <td >
                                 <input type="text" value="{{$item['pass_mark']}}"  class="form-control" disabled>
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
   @endforeach
</div>
@endsection
