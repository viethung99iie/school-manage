@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')

<div class="card">

    <form action="{{route('admins.update_setting')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
        <h3 class="">{{$title}}</h3>
            </div>
            @include('message')
                @if ($errors->any())
                    <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
                @endif
            @csrf
            <div class="form-group">
                <label for="example-email-input" class="form-control-label ">Tài khoản email doanh nghiệp</label>
                <input class="form-control" type="email" name="paypal_email" value="{{old('paypal_email') ? old('paypal_email') :  $setting}}">
                 @error('paypal_email')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            <div class="container">
                <button type="submit" class="btn btn-facebook">Cập nhật</button>
            </div>
    </form>
</div>
@endsection
