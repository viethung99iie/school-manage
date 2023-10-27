@extends('layouts.app')
@section('content')

<div class="card">
    <form action="{{route('admins.subject.store')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
        <h3 class="">Thêm môn học</h3>
            </div>
                @if ($errors->any())
        <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
    @endif
            @csrf
            {{-- name --}}
            <div class="form-group">
                <label for="example-text-input" class="form-control-label text-sm">Tên
                    môn học</label>
                <input class="form-control" type="text" name="name" value="{{old('name')}}" placeholder="Nhập tên..." >
                @error('name')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
            </div>
            {{-- type --}}
            <div class="form-group">
                <label for="exampleFormControlSelect1" class="text-sm">Thể loại</label>
                <select class="form-control " name="type">
                    <option value="">-- Chọn --</option>
                    <option value='Toán'>Toán</option>
                    <option value ='Lý'>Lý</option>
                    <option value ='Hóa'>Hóa</option>
                </select>
                @error('type')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
            </div>
            {{-- status --}}
            <div class="form-group">
                <label for="exampleFormControlSelect1" class="text-sm">Trạng thái</label>
                <select class="form-control " name="status">
                    <option value='0'>Hoạt động</option>
                    <option value ='1'>Ẩn</option>
                </select>
                @error('status')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
            </div>
            <div class="container">
                <button type="submit" class="btn btn-facebook">Thêm</button>
                <a href="{{route('admins.subject.list')}}" class="btn btn-warning ">Trở lại</a>
            </div>
    </form>
</div>
@endsection
