@extends('layouts.app')
@section('content')

<div class="card">
    <form action="{{route('admins.assign_subject.store')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
        <h3 class="">Đăng ký môn học cho các lớp</h3>
            </div>
                @if ($errors->any())
        <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
    @endif
            @csrf
            {{-- tên học phần
            <div class="form-group">
                <label for="example-text-input" class="form-control-label text-sm">Tên
                    Nhóm học phần</label>
                <input class="form-control" type="text" name="name" value="{{old('name')}}" placeholder="Nhập tên..." >
                @error('name')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
            </div> --}}
            {{-- Tên lớp học --}}
            <div class="form-group">
                <label for="exampleFormControlSelect1" class="text-sm">Lớp đăng ký</label>
                <select class="form-control " name="class_id">
                    @foreach ($class as $item)
                    <option value='{{$item->id}}'>{{$item->name}}</option>
                    @endforeach
                </select>
                @error('class_id')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
            </div>
            {{-- Tất cả môn học --}}
            <div class="form-group">
                <label for="exampleFormControlSelect1" class="text-sm">Môn học đăng ký</label>
                @foreach ($subjects as $item)
                <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$item->id}}" name="subject_id[]">
                        <label class="custom-control-label" for="customCheck1">{{$item->name}}</label>
                    </div>
                        @endforeach
                @error('subject_id')
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
