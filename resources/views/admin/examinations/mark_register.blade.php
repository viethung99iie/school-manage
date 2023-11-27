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
     @if (!empty($subjects) && !empty($subjects->count()))
      <div class='card mb-3'>
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                <h6>{{$title}}</h6>
                </div>
                        @csrf
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">

                    <table class="table table-striped">
                    <thead >
                        <th class="text-dark text-xs font-weight-bolder opacity-9">Sinh viên</th>
                        @foreach ($subjects as $item)
                        <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">{{$item->subject_name}} <br>
                            {{$item->pass_mark}}/{{$item->full_mark}}
                        </th>

                        @endforeach
                        <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2"></th>
                    </thead>

      <tbody>
         @if (!empty($students) && !empty($students->count()))
        @foreach ($students as $item)
        <form method="POST" class="submitForm">
            @csrf
        <input type="hidden" name="student_id" value="{{$item->id}}">
                    <input type="hidden" name="exam_id" value="{{Request::get('exam_id')}}">
                    <input type="hidden" name="class_id" value="{{Request::get('class_id')}}">
            <tr>
            <td>
                <div class="d-flex px-2">
                    <div class="my-auto">
                    <h5 class="mb-0 text-sm">{{$item['user_name']}}</h5>
                    </div>
                </div>
            </td>
            @php
                $i=1;
            @endphp
                @foreach ($subjects as $subject)
                    @php
                    $getMark = $subject->getMark($item->id,Request::get('exam_id'),Request::get('class_id'),$subject->subject_id);
                    @endphp
                <input type="hidden" name="mark[{{$i}}][subject_id]" value="{{$subject->subject_id}}">
                    <td>
                        <div style='width: 200px'>
                            Chuyên cần
                            <input type="text" name='mark[{{$i}}][class_work]' class="form-control" value="{{!empty($getMark->class_work)? $getMark->class_work:''}}">
                        </div>
                        <div style='width: 200px'>
                            Quá trình
                            <input type="text" name='mark[{{$i}}][home_work]' class="form-control" value="{{!empty($getMark->home_work)? $getMark->home_work:''}}"">
                        </div>
                        <div style='width: 200px'>
                            Giữa kì
                            <input type="text" name='mark[{{$i}}][test_work]' class="form-control" value="{{!empty($getMark->test_work)? $getMark->test_work:''}}"">
                        </div>
                        <div style='width: 200px'>
                            Cuối kì
                            <input type="text" name='mark[{{$i}}][exam]' class="form-control" value="{{!empty($getMark->exam)? $getMark->exam:''}}"">
                        </div>
                            <button type="button" class="btn-behance btn my-2 singleSubject" id="{{$item->id}}" data-val="{{$item->id}}" data-exam="{{Request::get('exam_id')}}" data-class="{{Request::get('class_id')}}">Cập nhật</button>
                    </td>
                    @php
                        $i++;
                    @endphp
                @endforeach
                <td>
                        <button type="submit" class="btn btn-success" data-schedule='{{$subject->subject_id}}' >Cập Nhật</button>
                </td>
        </tr>
                </form>

        @endforeach
        @endif
      </tbody>
                    </table>
<div class="row">
                    <div class="d-flex justify-content-center text-white">{{$students->links()}}</div>
                </div>

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
    $('.submitForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'Post',
            url: "{{route('admins.examinations.store_mark')}}",
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data){
                alert(data.message);
            }
        });
    });
    $('.singleSubject').click(function(e){
        var student_id = $(this).attr('id');
        var subject_id = $(this).attr('data-val');
        var exam_id = $(this).attr('data-exam');
        var class_id = $(this).attr('data-class');
        $.ajax({
            type: 'Post',
            url: "{{route('admins.examinations.store_mark_single')}}",
            data: {
                _token: " {{csrf_token()}} " ,
                student_id: student_id,
                subject_id: subject_id,
                exam_id: exam_id,
                class_id: class_id
            },
            dataType: 'json',
            success: function(data){
                alert(data.message);
            }
        });
    });
</script>
@endsection
