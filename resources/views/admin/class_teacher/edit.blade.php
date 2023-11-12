@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')

<div class="card">
    <form action="{{route('admins.class_teacher.update')}}" method="post" class="p-5">
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

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" placeholder="{{$class->name}}" class="form-control" disabled />
                            <input type="hidden" name="class_id" value="{{$class->id}}">
                        </div>
                    </div>
                @error('class_id')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
            </div>
            {{-- Tất cả môn học --}}

            <div class="form-group">
                <label for="exampleFormControlSelect1" class="text-sm">Giáo viên chủ nhiệm</label>
                @foreach ($teachers as $item)
                @php
                $checked = '';
                    foreach ($class->teachers as $key) {
                        if($key->id == $item->id){
                            $checked = 'checked';
                        }
                    }
                @endphp
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$item->id}}" name="teacher_id[]" {{$checked}}>
                        <label class="custom-control-label" for="customCheck1">{{$item->name}}</label>
                    </div>
                        @endforeach
                @error('teacher_id')
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
                <button type="submit" class="btn btn-facebook">Cập nhật</button>
                <a href="{{route('admins.class_teacher.list')}}" class="btn btn-warning ">Trở lại</a>
            </div>
    </form>
</div>
@endsection
