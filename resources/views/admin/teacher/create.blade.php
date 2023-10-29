@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')

<div class="card">
    <form action="{{route('admins.teacher.store')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
                <h3 class='d-flex justify-content-center'>{{$title}}</h3>
            </div>
                @if ($errors->any())
                    <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
                @endif
            @csrf
            {{-- row 1 --}}
            <div class="row">
                <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Họ và tên <span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="name" value="{{old('name')}}" placeholder="VD: Nguyễn Việt Hưng" >
                @error('name')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group col-6">
                    <label for="example-search-input" class="form-control-label">Mã Giảng Viên<span style="color: red;">*</span></label>
                    <input class="form-control" type="text" name="id_teacher" value="{{old('id_teacher')}}"  placeholder="VD: 22IT.B100" >
                    @error('id_teacher')
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
                </div> {{-- end 1 --}}

                <div class="form-group col-6">
                    <label for="example-search-input" class="form-control-label">Quê quán<span style="color: red;">*</span></label>
                    <input class="form-control" type="text" name="address" value="{{old('address')}}"  placeholder="VD: Thừa Thiên Huế" >
                    @error('address')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                    @enderror
                </div>
            </div>{{-- end row 2 --}}
            {{-- row 3 --}}
            <div class="row">
                {{-- 1 --}}
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
                {{-- end 1 --}}
                <div class="form-group col-6">
                    <label for="example-search-input" class="form-control-label">Dân tộc<span style="color: red;">*</span></label>
                    <input class="form-control" type="text" name="nation" value="{{old('nation')}}"  placeholder="VD: Kinh" >
                    @error('nation')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
            </div>{{-- end row 3 --}}
            {{-- row 4 --}}
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
            </div>{{-- end row 4 --}}
            {{-- row 5 --}}
            <div class="row">
                <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Chủ nhiệm lớp</label>
                <select class="form-control" name='class_id'>
                    <option >-- Lớp --</option>
                    @foreach ($class as $item)
                    <option value='{{$item->id}}' {{old('class_id')==$item->id?'selected':''}}>{{$item->name}}</option>
                    @endforeach
                </select>
                @error('class_id')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group col-6">
                    <label for="example-search-input" class="form-control-label">Tôn Giáo</label>
                    <input class="form-control" type="text" name="religion" value="{{old('religion')}}"  placeholder="VD: Không" >
                    @error('religion')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
            </div>{{-- end row 5 --}}
            {{-- row 6 --}}
            <div class="row">
                <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Kinh nghiệm<span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="work_exp" value="{{old('work_exp')}}" placeholder="VD: Nguyễn Trang" >
                @error('work_exp')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group col-6">
                    <label for="example-search-input" class="form-control-label">Chức Vụ<span style="color: red;">*</span></label>
                    <input class="form-control" type="text" name="position" value="{{old('position')}}"  placeholder="VD: Trưởng Khoa" >
                    @error('position')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
            </div>{{-- end row 1 --}}
            {{-- row 7 --}}
            <div class="row">
                <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Trình độ<span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="quafilication" value="{{old('quafilication')}}" placeholder="VD: Kĩ sư" >
                @error('quafilication')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group col-6">
                    <label for="example-search-input" class="form-control-label">Chuyên ngành<span style="color: red;">*</span></label>
                    <input class="form-control" type="text" name="department_id" value="{{old('department_id')}}"  placeholder="VD: Khoa học máy tính" >
                    @error('department_id')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
            </div>{{-- end row 1 --}}
             {{-- row 8 --}}
            <div class="row">
                {{-- 1 --}}
                <div class="form-group col-6">
                    <label for="example-search-input" class="form-control-label">Tình trạng hôn nhân<span style="color: red;">*</span></label>
                    <select class="form-control" name='marital_status'>
                        <option>-- Tình trạng --</option>
                        <option value='0' {{old('marital_status')=='0'?'selected':''}}>Không xác định</option>
                        <option value='1' {{old('marital_status')=='1'?'selected':''}}> Đọc thân</option>
                        <option value='2' {{old('marital_status')=='2'?'selected':''}}>Đã kết hôn</option>
                    </select>
                    @error('marital_status')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
                {{-- end 1 --}}
                <div class="form-group col-6">
                    <label for="example-search-input" class="form-control-label">Bắt đầu dạy<span style="color: red;">*</span></label>
                    <input class="form-control" type="date" name='date_join' value="{{old('date_card')}}">
                    @error('date_join')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
            </div>{{-- end row 5 --}}
                <hr>
                <div class="form-group">
                <label for="example-text-input" class="form-control-label">Email<span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="email" value="{{old('email')}}" placeholder="VD: viethung@gmail.com" >
            @error('email')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
             <div class="form-group">
                <label for="example-text-input" class="form-control-label">Di động</label>
                <input class="form-control" type="text" name="mobile_number" value="{{old('mobile_number')}}" placeholder="VD: 03xxxxxx" >
            @error('mobile_number')
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
                <a href="{{route('admins.teacher.list')}}" class="btn btn-warning ">Trở lại</a>
            </div>
    </form>
</div>


@endsection
