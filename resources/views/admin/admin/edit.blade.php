@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')

<div class="card">
    <form action="{{route('admins.admin.update')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
        <h3 class="">Chỉnh sửa quản trị viên</h3>
            </div>
                @if ($errors->any())
                    <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
                    @endif
            @csrf
            <div class="row">
                <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Tên</label>
                <input class="form-control" type="text" name="name" value="{{$admin->name}}" placeholder="Nhập tên..." >
            @error('name')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group col-6">
                <label for="example-search-input" class="form-control-label">Mật khẩu</label>
                <input class="form-control" type="password" name="password" value="{{old('password')}}"  placeholder="Nhập mật khẩu..." >
            @error('password')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            </div>
            <div class="form-group">
                <label for="example-email-input" class="form-control-label ">Email</label>
                <input class="form-control" type="email" name="email" value="{{$admin->email}}"   placeholder="@example.com" >
            @error('email')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
               <div class="container">
                <button type="submit" class="btn btn-facebook">Thêm</button>
                <a href="{{route('admins.admin.list')}}" class="btn btn-warning ">Trở lại</a>
            </div>
    </form>
</div>
@endsection
