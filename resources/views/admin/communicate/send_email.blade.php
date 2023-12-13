@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
<div class="card">
    <form action="{{route('admins.communicate.send_email_user')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
        <h3 class="">{{$title}}</h3>
            </div>
                @if ($errors->any())
                    <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
                @endif
            @csrf
            <div class="form-group ">
                <label for="example-search-input" class="form-control-label">Tiêu đề</label>
                <input class="form-control" type="text" name="title" value="{{old('title')}}"  placeholder="Nhập tiêu đề" >
                @error('title')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            <div class="form-check ">
                <label class="form-control-label d-block" >Gửi tới : </label>
                <label class="form-control-label mx-5"><input type="checkbox" class="form-check-input" value="3" name='messto[]'> Sinh viên</label>
                <label class="form-control-label mx-5"><input type="checkbox" value="2"  class="form-check-input" name='messto[]'> Giảng viên</label>
                <label class="form-control-label mx-5"><input type="checkbox" value="4"  class="form-check-input" name='messto[]'> Phụ huynh</label>
            </div>

            <div class="form-group">
                 <label class="form-control-label d-block" >Nội dung  </label>
                   <textarea name="message" id="editor" rows="5" class="form-control " style="resize: none;">{{old('message')}}</textarea>
                @error('message')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
            <div class="container">
                <button type="submit" class="btn btn-facebook">Thêm</button>
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
