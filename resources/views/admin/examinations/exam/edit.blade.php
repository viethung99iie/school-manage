@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')

<div class="card">

    <form action="{{route('admins.examinations.exam.update')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
        <h3 class="">{{$title}}</h3>
            </div>
                @if ($errors->any())
                    <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
                @endif
            @csrf
                <div class="form-group ">
                <label for="example-text-input" class="form-control-label">Tên bài thi</label>
                <input class="form-control" type="text" name="name" value="{{old('name') ?? $exam->name}}" placeholder="Nhập tên..." >
            @error('name')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group">
                <label  class="form-control-label ">Ghi chú</label>
                <textarea name="note" id="editor" rows="5" class="form-control mb-2" style="resize: none;">{{old('note') ?? $exam->note}}</textarea>
                 @error('note')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            <div class="container">
                <button type="submit" class="btn btn-facebook">Cập nhật</button>
                <a href="{{route('admins.examinations.exam.list')}}" class="btn btn-warning ">Trở lại</a>
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
