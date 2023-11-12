@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
<div class='card mb-3'>
        <div class="row">
            <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                <h6>Sinh viên của tôi</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                    <thead >
        <tr class="">
          <th  class=" text-dark text-xs font-weight-bolder opacity-9">Sinh Viên</th>
           <th  class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">MSV</th>
            <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Lớp</th>
             <th class=" text-dark text-xs font-weight-bolder opacity-9 ps-2">Giới tính</th>
             <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày nhập học</th>
          <th class="text-dark text-sm font-weight-bolder opacity-9 ps-2">Hành động</th>
        </tr>
      </thead>
            <tbody>
            @foreach ($my_students as $item)
                                <td>
                <div class="d-flex px-2 py-1">
                <div>
                     @if ($item->user_avatar!=null)
                        <img src="{{ asset('image/'.$item->user_avatar) }}" class="avatar avatar-sm me-3" alt="user1">
                    @else
                        <img src="{{ asset('image/default.png') }}" class="avatar avatar-sm me-3" alt="user1">
                    @endif
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{$item->user_name}}</h6>
                    <p class="text-xs text-secondary mb-0">{{$item->user_email}}</p>
                </div>
                </div>
            </td>
          <td >
            <span class="badge badge-dot me-2">
              <span class="text-secondary text-xs">{{$item->id_student}}</span>
            </span>
          </td>
          <td>
            <span class="badge badge-dot me-2">
              <span class="text-secondary text-xs">{{$item->class_name}}</span>
            </span>
          </td>
          <td>
            <span class="badge badge-dot me-2">
              <span class="text-secondary text-xs">{{$item->gender}}</span>
            </span>
          </td>

          <td class="align-middle text-center">
            <div class="d-flex align-items-center">
              <span class=" text-secondary me-2 text-sm">{{$item->date_admission}}</span>
            </div>
          </td>

          <td class="align-middle">
            <div class="ms-auto text-start">
                {{-- xóa --}}
                <a class="btn btn-primary" href="{{ route('parents.student.subject', ['id'=>$item->id])}}">
                   Môn học
                </a>
            </div>
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
@endsection
