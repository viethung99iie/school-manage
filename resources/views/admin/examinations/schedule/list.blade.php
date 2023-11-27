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
                        <label for="example-text-input" class="form-control-label" >Kì thi</label>
                         <select class="form-control getClass" name='exam_id'>
                    <option >Chọn</option>
                    @foreach ($exams as $item)
                    <option value='{{$item->id}}' {{Request::get('exam_id')==$item->id?'selected':''}}>{{$item->name}}</option>
                    @endforeach
                </select>
                    </div>
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Môn học</label>
                       <select name="class_id" class='form-control getSubject' id="">
                        <option value="">Chọn</option>
                            @foreach ($class as $item)
                                <option value='{{$item['id']}}' {{Request::get('class_id')==$item['id']?'selected':''}}>{{$item['name']}}</option>
                            @endforeach
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
    @if (!empty($subjects))
      <div class='card mb-3'>
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                <h6>{{$title}}</h6>
                </div>
                <form action="{{route('admins.examinations.schedule.store')}}" method="post">
                        @csrf
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-striped">
                        <input type="hidden" name='class_id' class="form-control" value='{{Request::get('class_id')}}'>
                          <input type="hidden" name='exam_id' class="form-control" value="{{Request::get('exam_id')}}">
                    <thead >
                        <th class="text-dark text-xs font-weight-bolder opacity-9">Môn học</th>
                        <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày thi</th>
                        <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Bắt Đầu</th>
                        <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Kết thúc</th>
                        <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Phòng thi</th>
                        <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm</th>
                        <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm liệt</th>
                        <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2"></th>
                    </thead>
                    @php
                                $i=1;
                    @endphp
      <tbody>
         @foreach ($subjects as $item)
            <tr>
          <td>
            <div class="d-flex px-2">
              <div class="my-auto">
                <input type="hidden" name="timetable[{{$i}}][subject_id]" class="form-control" value='{{$item['subject_id']}}'>
                <h5 class="mb-0 text-sm">{{$item['subject_name']}}</h5>
              </div>
            </div>
          </td>
           <td>
            <input type="date" name="timetable[{{$i}}][exam_date]" value="{{$item['exam_date']}}" class="form-control">
          </td>
          <td>
          <input type="time" name='timetable[{{$i}}][start_time]' value="{{$item['start_time']}}" class="form-control">
          </td>
           <td>
            <input type="time" name='timetable[{{$i}}][end_time]' value="{{$item['end_time']}}" class="form-control">
          </td>
           <td >
            <input type="text" name='timetable[{{$i}}][room]' value="{{$item['room']}}"  class="form-control">
          </td>
          <td >
            <input type="text" name='timetable[{{$i}}][full_mark]' value="{{$item['full_mark']}}"  class="form-control">
          </td>
          <td >
            <input type="text" name='timetable[{{$i}}][pass_mark]' value="{{$item['pass_mark']}}"  class="form-control">
          </td>
           <td>
            <a href="{{ route('admins.schedule.delete', ['exam_id'=>Request::get('exam_id'),'class_id'=>Request::get('class_id'),'subject_id'=>$item['subject_id']]) }}" class="btn btn-dribbble mx-2">Xóa</a>
          </td>
        </tr>
        @php
                    $i++;
                @endphp
        @endforeach


      </tbody>
        </table>
                </div>
                </div>
                <div class="d-flex justify-content-center">
                        <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                        <a href="{{ route('admins.schedule.delete_all', ['exam_id'=>Request::get('exam_id'),'class_id'=>Request::get('class_id')]) }}" class="btn btn-dribbble mx-2">Xóa tất cả</a>
                     </div>
            </div>
            </div>
            </form>
        </div>
    </div>
    @endif
   </div>
@endsection
