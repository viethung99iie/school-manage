@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
    @include('message')
<div class="p-2">
    <div class="card mb-3">
        <div class="card-header pb-0 d-flex">
        <div class="col-7">
            <h6>Tìm kiếm giảng viên</h6>
        </div>
        <div class="col-5 text-end">
            <a class="btn bg-gradient-primary m-0 text-white" href="{{route('admins.teacher.create')}}">
                <i class="fas fa-plus">
                </i>&nbsp;&nbsp;Thêm giảng viên
            </a>
        </div>
        </div>
            <form action="" method="GET" class="mx-3 ">
            <div class="row">
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Tên</label>
                        <input type="text" name="name" class="form-control" placeholder="VD: Nguyễn Việt Hưng"
                        value="{{request()->name}}">
                    </div>
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="VD: example@gmail.com"
                        value="{{request()->email}}">
                    </div>
                    <div class="col-2">
                        <label for="example-text-input" class="form-control-label ">Mã giảng viên</label>
                        <input type="text" name="id_teacher" class="form-control" placeholder="VD: 15CS7"
                        value="{{request()->id_teacher}}">
                    </div>

                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Ngày bắt đầu</label>
                        <input type="date" name="date_of_birth" class="form-control"
                        value="{{request()->date_of_birth}}"  min="01/01/2000" max="31/12/2023">
                    </div>
        </div>
        <div class="row mb-0">
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Di động</label>
                        <input type="text" name="mobile" class="form-control" placeholder="VD: 091232xxx"
                        value="{{request()->mobile}}">
                    </div>
                    <div class="col-3">
                        <label for="example-text-input" class="form-control-label ">Trình độ</label>
                        <input type="text" name="quafilication" class="form-control" placeholder="VD: Tiến sĩ"
                        value="{{request()->quafilication}}">
                    </div>
                    <div class="col-2">
                        <input type="text" class="opacity-0" >
                        <button type="submit" class="btn btn-primary btn-block">Tìm Kiếm</button>
                    </div>
            </div>
                </form>
    </div>
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
            <th class="text-dark text-xs font-weight-bolder opacity-9 ">Giảng viên</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">MGV</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Giới tính</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Di động</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Bắt đầu</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày sinh</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Địa chỉ</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Trình độ</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Kinh nghiệm</th>
            <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Hàng động</th>
      </thead>
      <tbody>
         @foreach ($teachers as $item)
            <tr>
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
                <span class="text-secondary text-xs">{{$item->id_teacher}}</span>
                </span>
            </td>
            <td>
                <span class="badge badge-dot me-2">
                <span class="text-secondary text-xs">{{$item->gender}}</span>
                </span>
            </td>
            <td>
                <span class="badge badge-dot me-2">
                <span class="text-secondary text-xs">{{$item->user_mobile}}</span>
                </span>
            </td>
            <td>
                <div class="d-flex align-items-center">
                <span class=" text-secondary me-2 text-sm">{{$item->date_join}}</span>
                </div>
            </td>
            <td>
                <span class="d-flex align-items-center">
                <span class="text-secondary me-2 text-sm">{{$item->date_of_birth}}</span>
                </span>
            </td>
            <td>
                <span class="badge badge-dot me-2">
                <span class="text-secondary text-xs">{{$item->address}}</span>
                </span>
            </td>
            <td>
                @php
                    $item->quafilication = substr($item->quafilication, 0, 30);
                    $item->work_exp = substr($item->work_exp, 0, 30);
                @endphp
                <span class="badge badge-dot me-2">
                <span class="text-secondary text-xs">{!!$item->quafilication!!}...</span>
                </span>
            </td>
            <td>
                <span class="badge badge-dot me-2">
                <span class="text-secondary  text-xs">{!!$item->work_exp!!}</span>
                </span>
            </td>
            <td class="align-middle">
                <div class="ms-auto text-start">
                    {{-- xóa --}}
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="{{ route('admins.teacher.delete', ['id'=>$item->user_id])}}">
                        <i class="far fa-trash-alt me-2"></i>Xóa
                    </a>
                    {{-- sửa --}}
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('admins.teacher.edit', ['id'=>$item->id])}}">
                        <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Sửa
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
      </tbody>
        </table>
                </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-center text-white">{{$teachers->links()}}</div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
