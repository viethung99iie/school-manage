@extends('layouts.app')
@section('content')

<div class="card">

    <form action="{{route('admins.parent.store')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
        <h3 class='d-flex justify-content-center'>Thêm phụ huynh</h3>
            </div>
                @if ($errors->any())
                    <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
                @endif
            @csrf
            {{-- row 1 --}}
            <div class="row">
                <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Họ và tên <span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="name" value="{{old('name')}}" placeholder="Nhập họ và tên..." >
            @error('name')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
                <div class="form-group col-6">
                    <label for="example-text-input" class="form-control-label">Giới tính<span style="color: red;">*</span></label>
                    <select class="form-control" name='gender'>
                    <option value="" >-- Chọn giới tính--</option>
                    <option value="male" {{old('gender')==='male'?'selected':''}}>Nam</option>
                    <option value="female" {{old('gender')==='female'?'selected':''}}>Nữ</option>
                    <option value="other" {{old('gender')==='other'?'selected':''}}>Khác</option>
                    </select>
                    @error('gender')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                    @enderror
                </div>
            </div>{{-- end row 1 --}}
            {{-- row 2 --}}
            <div class="row">
            {{-- 1 --}}
            <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Ngày sinh<span style="color: red;">*</span></label>
        <input class="form-control" type="date" name='date_of_birth' value="{{old('date_of_birth')}}">
            @error('date_of_birth')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            {{-- end 1 --}}
            <div class="form-group col-6">
                <label for="example-search-input" class="form-control-label">Quê quán<span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="native" value="{{old('native')}}"  placeholder="VD: Thừa Thiên Huế" >
                @error('native')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            </div>{{-- end row 2 --}}
            {{-- row 3 --}}
            <div class="row">
            {{-- 1 --}}

            {{-- end 1 --}}

            </div>{{-- end row 3 --}}
            {{-- row 3 --}}
            <div class="row">
            {{-- 1 --}}
            <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Căn cứa công dân<span style="color: red;">*</span></label>
                <input class="form-control" type="number" name="id_card" value="{{old('id_card')}}"  placeholder="VD: 02382183823..." >
            @error('id_card')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            {{-- end 1 --}}
            <div class="form-group col-6">
                <label for="example-search-input" class="form-control-label">Ngày cấp<span style="color: red;">*</span></label>
                <input class="form-control" type="date" name='date_card' value="{{old('date_card')}}">
                @error('date_card')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            </div>{{-- end row 3 --}}
             {{-- row 5 --}}
            <div class="row">
                <div class="form-group col-6">
                    <label for="example-search-input" class="form-control-label">Dân tộc<span style="color: red;">*</span></label>
                    <input class="form-control" type="text" name="nation" value="{{old('nation')}}"  placeholder="VD: Kinh" >
                    @error('nation')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
            {{-- 1 --}}
              <div class="form-group col-6">
                <label for="example-search-input" class="form-control-label">Trạng thái<span style="color: red;">*</span></label>
                <select class="form-control" name='status'>
                    <option>-- Trạng thái --</option>
                    <option value='0' {{old('status')==='0'?'selected':''}}>Xuất hiện</option>
                    <option value='1' {{old('status')==='1'?'selected':''}}>Ẩn</option>
                </select>
                @error('status')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            {{-- end 1 --}}

            </div>{{-- end row 5 --}}
                <hr>
                <div class="form-group">
                <label for="example-text-input" class="form-control-label">Email<span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="email" value="{{old('email')}}" placeholder="VD: viethung@gmail.com" >
            @error('email')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group ">
                <label for="example-search-input" class="form-control-label">Mật khẩu<span style="color: red;">*</span></label>
                <input class="form-control" type="password" name="password" value="{{old('password')}}"  placeholder="Nhập mật khẩu..." >
                @error('password')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            <div class="container">
                <button type="submit" class="btn btn-facebook">Thêm</button>
                <a href="{{route('admins.parent.list')}}" class="btn btn-warning ">Trở lại</a>
            </div>
    </form>
</div>


@endsection
