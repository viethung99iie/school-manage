@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
 <div class="card py-2">
    <div class="card-header pb-0">
                <h6>Môn học của tôi</h6>
                </div>
    <table class="table align-items-center mb-0 ">
      <thead >
        <tr >
           <th  class=" text-dark text-xs font-weight-bolder opacity-9 " style="width: 50%;">Môn học</th>
            <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Thể loại</th>
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
            <span class="badge badge-dot me-2">
              <span class="text-secondary text-xs">{{$item->subject_type}}</span>
            </span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
 </div>
@endsection
