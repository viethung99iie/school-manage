@extends('layouts.app')
@section('content')

<div class="card">

    <form action="{{route('admins.student.update')}}" method="post" class="p-5">
        @csrf
            <div class="row d-flex justify-content-lg-end">
        <h3 class='d-flex justify-content-center text-uppercase'>Chỉnh sửa sinh viên</h3>
            </div>
                @if ($errors->any())
                    <div class="alert alert-danger text-center text-white">Vui lòng kiểm tra lại thông tin </div>
                @endif
            @csrf
            <div class="row">
                <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Họ và tên <span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="name" value="{{old('name') ?? $student->user_name}}" placeholder="Nhập họ và tên..." >
            @error('name')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group col-6">
                <label for="example-search-input" class="form-control-label">Mã sinh viên<span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="id_student" value="{{old('id_student') ?? $student->id_student}}}}"  placeholder="VD: 22IT.B100" >
                @error('id_student')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            </div>{{-- end row 1 --}}
            {{-- row 2 --}}
            <div class="row">
            {{-- 1 --}}
            <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Ngày sinh<span style="color: red;">*</span></label>
        <input class="form-control" type="date" name='date_of_birth' value={{$student->date_of_birth}}>
            @error('date_of_birth')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            {{-- end 1 --}}
            <div class="form-group col-6">
                <label for="example-search-input" class="form-control-label">Quê quán<span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="native" value="{{old('native') ?? $student->native}}"  placeholder="VD: Thừa Thiên Huế" >
                @error('native')
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
                <option value="male" {{$student->gender==='male'?'selected':''}}>Nam</option>
                <option value="female" {{$student->gender==='female'?'selected':''}}>Nữ</option>
                <option value="other" {{$student->gender==='other'?'selected':''}}>Khác</option>
            </select>
            @error('gender')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            {{-- end 1 --}}
            <div class="form-group col-6">
                <label for="example-search-input" class="form-control-label">Dân tộc<span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="nation" value="{{old('nation') ?? $student->nation}}"  placeholder="VD: Kinh" >
                @error('nation')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            </div>{{-- end row 3 --}}
            {{-- row 3 --}}
            <div class="row">
            {{-- 1 --}}
            <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Căn cứa công dân<span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="id_card" value="{{old('id_card') ?? $student->id_card}}"  placeholder="VD: 02382183823..." >
            @error('id_card')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            {{-- end 1 --}}
            <div class="form-group col-6">
                <label for="example-search-input" class="form-control-label">Ngày cấp<span style="color: red;">*</span></label>
                <input class="form-control" type="date" name='date_card' value="{{$student->date_card}}">
                @error('date_card')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            </div>{{-- end row 3 --}}
            {{-- row 4 --}}
            <div class="row">
                <div class="form-group col-6">
                <label for="example-text-input" class="form-control-label">Lớp<span style="color: red;">*</span></label>
                <select class="form-control" name='class_id'>
                    <option >-- Lớp --</option>
                    @foreach ($class as $item)
                    <option value='{{$item->id}}' {{$student->class_id==$item->id?'selected':''}}>{{$item->name}}</option>
                    @endforeach
                </select>
            @error('class_id')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group col-6">
                <label for="example-search-input" class="form-control-label">Tôn Giáo</label>
                <input class="form-control" type="text" name="religion" value="{{old('religion') ?? $student->religion}}"  placeholder="VD: Không" >
                @error('religion')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            </div>{{-- end row 4 --}}
             {{-- row 5 --}}
            <div class="row">
            {{-- 1 --}}
                <div class="form-group col-6">
                <label for="example-search-input" class="form-control-label">Trạng thái<span style="color: red;">*</span></label>

                <select class="form-control" name='status'>
                    <option>-- Trạng thái --</option>
                    <option value='3' {{$student->status=='3'?'selected':''}}>Đang theo học</option>
                    <option value='4' {{$student->status=='4'?'selected':''}}> Đã tốt nghiệp</option>
                    <option value='5' {{$student->status=='5'?'selected':''}}>Bảo lưu kết quả</option>
                </select>
                @error('status')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            {{-- end 1 --}}
            <div class="form-group col-6">
                <label for="example-search-input" class="form-control-label">Ngày nhập học<span style="color: red;">*</span></label>
                <input class="form-control" type="date" name='date_admission' value="{{$student->date_admission}}">
                @error('date_admission')
                <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
            </div>
            </div>{{-- end row 5 --}}

                <hr>
                <div class="form-group">
                <label for="example-text-input" class="form-control-label">Email<span style="color: red;">*</span></label>
                <input class="form-control" type="text" name="email" value="{{old('email') ?? $student->user_email}}" placeholder="VD: viethung@gmail.com" >
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
                <button type="submit" class="btn btn-facebook">Cập nhật</button>
                <a href="{{route('admins.student.list')}}" class="btn btn-warning ">Trở lại</a>
            </div>
    </form>
</div>


@endsection
