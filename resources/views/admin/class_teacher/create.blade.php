@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')

<div class="card">
    <form action="{{route('admins.class_teacher.store')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
        <h3 class="">{{$title}}</h3>
            </div>
                @if ($errors->any())
        <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
    @endif
            @csrf
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
            {{-- Tất cả giáo viên --}}
            <div class="form-group">
                <label for="exampleFormControlSelect1" class="text-sm">Giáo viên chủ nhiệm</label>
                @foreach ($teachers as $item)
                <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$item->id}}" name="teacher_id[]">
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
                <button type="submit" class="btn btn-facebook">Cập nhật</button>
                <a href="{{route('admins.class_teacher.list')}}" class="btn btn-warning ">Trở lại</a>
            </div>
    </form>
</div>
@endsection
