@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
<div class="card">
    <form action="{{route('admins.class.update')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
        <h3 class="">Chỉnh sửa lớp học</h3>
            </div>
                @if ($errors->any())
    <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
                @endif
            @csrf
            {{-- name --}}
            <div class="form-group">
                <label for="example-text-input" class="form-control-label text-sm">Tên lớp</label>
                <input class="form-control" type="text" name="name" value="{{$class->name}}" placeholder="Nhập tên..." >
                @error('name')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
            </div>
            {{-- amount --}}
            <div class="form-group">
                <label for="example-text-input" class="form-control-label text-sm">Học phí 1 kì (VNĐ)</label>
                <input class="form-control" type="text" name="amount" value="{{$class->amount}}" placeholder="Nhập học phí..." >
                @error('amount')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
            </div>
            {{-- status --}}
            <div class="form-group">
                <label for="exampleFormControlSelect1" class="text-sm">Trạng thái</label>
                <select class="form-control " name="status">
                    <option value='0'{{$class->status==0?'selected':''}}>Hoạt động</option>
                    <option value ='1' {{$class->status==1?'selected':''}}>Ẩn</option>
                </select>
                @error('status')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
            </div>
            <div class="container">
                <button type="submit" class="btn btn-facebook">Thêm</button>
                <a href="{{route('admins.class.list')}}" class="btn btn-warning ">Trở lại</a>
            </div>
    </form>
</div>
@endsection
