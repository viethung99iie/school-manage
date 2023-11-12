@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
<div class="p-2">
     @include('message')
   <div class='card mb-3'>
      <div class="row">
         <div class="col-12">
            <div class="card mb-4">
               <div class="card-header pb-0">
                  <h6>Danh sách lớp </h6>
               </div>
               <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                     <table class="table table-responsive">
                        <thead >
                           <tr class="">
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ">Tên lớp</th>
                               <th class="text-dark text-xs font-weight-bolder opacity-9 ">Môn học</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Hành động</th>
                           </tr>
                        </thead>
                        <tbody>
                  @foreach ($class as $item)
        <tr>
          <td>
            <h5 class="mb-0 text-secondary text-sm px-4">{{$item->class_name}}</h5>
          </td>
          <td>
            <h5 class="mb-0 text-secondary text-sm px-4">{{$item->subject_name}}</h5>
          </td>
           <td>
            <a class="btn btn-link text-primary px-2 mb-0" href="{{ route('teachers.my_student', ['class_id'=>$item->class_id])}}">
                        <i class="fa-solid fa-clipboard-list text-primary me-2" aria-hidden="true"></i>Danh sách
                    </a>
            <a class="btn btn-link text-warning mb-0" href="{{ route('teachers.class_timetable', ['class_id'=>$item->class_id,'subject_id'=>$item->subject_id])}}">
                        <i class="fa-solid fa-calendar-days text-warning me-2" aria-hidden="true"></i>Lịch giảng dạy </a>
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
@section('javascript')
<script src="{{asset("assets/js/app.js")}}"></script>
@endsection
