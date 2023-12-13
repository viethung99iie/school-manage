@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')

<div class="card">

    <form action="{{route('admins.communicate.update')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
        <h3 class="">{{$title}}</h3>
            </div>
                @if ($errors->any())
                    <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
                @endif
            @csrf
            <div class="form-group ">
                <label for="example-search-input" class="form-control-label">TIêu đề</label>
                <input class="form-control" type="text" name="title" value="{{$notice->title}}"  placeholder="Nhập tiêu đề" >
                @error('title')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group ">
                <label for="example-search-input" class="form-control-label">Ngày thông báo</label>
                <input class="form-control" type="date" name="notice_date" value="{{$notice->notice_date}}">
                @error('notice_date')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group ">
                <label for="example-search-input" class="form-control-label">Ngày công khai</label>
                <input class="form-control" type="date" name="publish_date" value="{{$notice->publish_date}}">
                @error('publish_date')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            @php
                $checkStudent = $notice->checkAlreadyExists($notice->id,3);
                $checkTeacher = $notice->checkAlreadyExists($notice->id,2);
                $checkParent = $notice->checkAlreadyExists($notice->id,4);
            @endphp
            <div class="form-check">
                <label class="form-control-label d-block" >Gửi tới : </label>
                <label class="form-control-label"><input {{!empty($checkStudent)?'checked':''}} class="form-check-input" type="checkbox" value="3" name='messto[]'> Sinh viên</label>
                <label class="form-control-label mx-5"><input type="checkbox"
                     class="form-check-input" {{!empty($checkTeacher)?'checked':''}} value="2"  name='messto[]'> Giảng viên</label>
                <label class="form-control-label"><input type="checkbox"
                     class="form-check-input" {{!empty($checkParent)?'checked':''}} value="4"  name='messto[]'> Phụ huynh</label>
            </div>

            <div class="form-group">
                   <textarea name="message" id="editor" rows="5" class="form-control " style="resize: none;">{{$notice->message}}</textarea>
                @error('message')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
            <div class="container">
                <button type="submit" class="btn btn-facebook">Cập nhật</button>
                <a href="{{route('admins.communicate.list')}}" class="btn btn-warning ">Trở lại</a>
            </div>
    </form>
</div>
<script>
            ClassicEditor.create(document.querySelector("#editor")).catch(
                (error) => {
                    console.error(error);
                }
            );

        </script>

@endsection
