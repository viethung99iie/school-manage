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
                    <option value='{{$item->exam_id}}' {{Request::get('exam_id')==$item->exam_id?'selected':''}}>{{$item->exam_name}}</option>
                    @endforeach
                </select>
                    </div>
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Môn học</label>
                       <select name="class_id" class='form-control getSubject' id="">
                        <option value="">Chọn</option>
                            @foreach ($class as $item)
                                <option value='{{$item->class_id}}' {{Request::get('class_id')==$item->class_id?'selected':''}}>{{$item->class_name}}</option>
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
                        <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">{{$item->subject_name}}
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
                $total = 0;
                $i=1;
                $bad = 0;
                $gpa = 0 ;
            @endphp
                @foreach ($subjects as $subject)
                    @php
                    $getMark = $subject->getMark($item->id,Request::get('exam_id'),Request::get('class_id'),$subject->subject_id);
                    if(!empty($getMark)){
                        $total = ($getMark->class_work*0.1 + $getMark->home_work*0.2 + $getMark->test_work*0.2 + $getMark->exam*0.5);
                    }
                    @endphp
                <input type="hidden" name="mark[{{$i}}][full_mark]" value="{{$subject->full_mark}}">
                <input type="hidden" name="mark[{{$i}}][pass_mark]" value="{{$subject->pass_mark}}">
                <input type="hidden" name="mark[{{$i}}][id]" value="{{$subject->id}}">
                <input type="hidden" name="mark[{{$i}}][subject_id]" value="{{$subject->subject_id}}">
                    <td>
                        <div style='width: 150px'>
                            Chuyên cần
                            <input type="text" id='class_work_{{$item->id.$subject->subject_id}}' name='mark[{{$i}}][class_work]' class="form-control" value="{{!empty($getMark->class_work)? $getMark->class_work:''}}">
                        </div>
                        <div style='width: 150px'>
                            Quá trình
                            <input type="text" id='home_work_{{$item->id.$subject->subject_id}}' name='mark[{{$i}}][home_work]' class="form-control" value="{{!empty($getMark->home_work)? $getMark->home_work:''}}"">
                        </div>
                        <div style='width: 150px'>
                            Giữa kì
                            <input type="text" id='test_work_{{$item->id.$subject->subject_id}}' name='mark[{{$i}}][test_work]' class="form-control" value="{{!empty($getMark->test_work)? $getMark->test_work:''}}"">
                        </div>
                        <div style='width: 150px'>
                            Cuối kì
                            <input type="text" id='exam_{{$item->id.$subject->subject_id}}' name='mark[{{$i}}][exam]' class="form-control" value="{{!empty($getMark->exam)? $getMark->exam:''}}"">
                        </div>
                            <button type="button" class="btn-behance btn my-2 singleSubject" id="{{$item->id}}" data-val="{{$subject->subject_id}}" data-exam="{{Request::get('exam_id')}}" data-class="{{Request::get('class_id')}}" data-schedule='{{$subject->id}}'>Cập nhật</button>

                        @if ($total!==0)
                            <div class="form-control" style='width: 150px'>
                              <b> Tổng điểm:</b> {{$total}} <br>
                              <b> Điểm tối thiểu:</b> {{$subject->pass_mark}}<br>
                                @if ($total>=$subject->pass_mark)
                                    <span class="text-bolder text-success">Qua môn</span>
                                @else
                                @php
                                    $bad++;
                                @endphp
                                    <span class="text-bolder text-danger">Thi lại</span>
                                @endif
                            </div>
                        @endif
                    </td>
                    @php
                    $i++;
                    $gpa += $total;
                    @endphp
                @endforeach
                <td>
                    <button type="submit" style="width: 150px" class="btn btn-success">Cập Nhật</button>
                        <div class="form-control">
                        <b> GPA :</b> {{round($gpa/($i-1), 2)}}/10 <br>
                        <b> Số môn thi lại :</b> {{$bad}}/{{$i-1}} <br>
                            </div>
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
            url: "{{route('teachers.store_mark')}}",
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data){
                alert(data.message);
            }
        });
    });
    $('.singleSubject').click(function(e){
        var id = $(this).attr('data-schedule');
        var student_id = $(this).attr('id');
        var subject_id = $(this).attr('data-val');
        var exam_id = $(this).attr('data-exam');
        var class_id = $(this).attr('data-class');
        var class_work = $('#class_work_'+student_id+subject_id).val();
        var home_work = $('#home_work_'+student_id+subject_id).val();
        var test_work = $('#test_work_'+student_id+subject_id).val();
        var exam = $('#exam_'+student_id+subject_id).val();
        $.ajax({
            type: 'Post',
            url: "{{route('teachers.store_mark_single')}}",
            data: {
                "_token": "{{csrf_token()}}" ,
                id: id,
                student_id: student_id,
                subject_id: subject_id,
                exam_id: exam_id,
                class_id: class_id,
                class_work: class_work,
                home_work: home_work,
                test_work: test_work,
                exam: exam
            },
            dataType: 'json',
            success: function(data){
                alert(data.message);
            }
        });
    })
</script>
@endsection
