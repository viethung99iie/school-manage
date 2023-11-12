@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
 <div class="card py-2">
    <div class="card-header pb-0 ">
                <h6 class="d-flex">Môn học (<p class="text-primary text-x">{{$student_name}}</p>)</h6>

                </div>
    <table class="table align-items-center mb-0 ">
      <thead >
        <tr >
           <th  class=" text-dark text-xs font-weight-bolder opacity-9 " style="width: 50%;">Môn học</th>
            <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($subjects as $item)
          <td >
            <span class="badge badge-dot me-2">
              <span class="text-secondary text-xs">{{$item->subject_name}}</span>
            </span>
          </td>
          <td>
            <a class="btn btn-link text-warning mb-0" href="{{ route('parents.class_timetable', ['class_id'=>$item->class_id,'subject_id'=>$item->subject_id])}}">
                        <i class="fa-solid fa-calendar-days text-warning me-2" aria-hidden="true"></i>Lịch học</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
 </div>
@endsection
