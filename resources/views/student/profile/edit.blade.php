@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
 <div class="container py-5">
      <div class="row mb-3">
        <div class="col-lg-4">
          <div class="card mb-4">
            <form action="">
                <div class="card-body text-center">
                    @if($student->user_avatar!=null)
                        <img src="{{ asset('image/'.$student->user_avatar) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    @else
                        <img src="{{ asset('image/default.png') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    @endif
              <h5 class="my-3">{{$student->user_name}}</h5>
              <!-- Button trigger modal -->
            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Thay đổi Avatar
            </button>
            </div>
            </form>
          </div>
         {{-- thông tin liên hệ mạng xã hội --}}
           <div class="card mb-4 mb-lg-0">
            <div class="card-body p-0">
              <ul class="list-group list-group-flush rounded-3">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fas fa-globe fa-lg text-warning"></i>
                  <p class="mb-0">https://mdbootstrap.com</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                  <p class="mb-0">mdbootstrap</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                  <p class="mb-0">@mdbootstrap</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                  <p class="mb-0">mdbootstrap</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                  <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                  <p class="mb-0">mdbootstrap</p>
                </li>
              </ul>
            </div>
          </div>
         {{-- kết thúc thông tin liên hệ mạng xã hội --}}
        </div>
        <div class="col-lg-8">
            @include('message')
          <form action="{{route('students.profile.update')}}" method="post">
            @csrf
            <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Thông tin cơ bản</h6>
                </div>
            <div class="card-body">
              <div class="row mb-3 ">
                <div class="col-sm-3">
                  <p class="mb-0">Họ và tên</p>
                </div>
                <div class="col-sm-9">
                  <input class="form-control" type="text" name="name" value="{{old('name') ?? $student->user_name}}" placeholder="VD: Nguyễn Việt Hưng" >
                @error('name')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
              </div>

              <div class="row mb-3 ">
                <div class="col-sm-3">
                  <p class="mb-0">Mã giảng viên</p>
                </div>
                <div class="col-sm-9">
                  <input class="form-control" type="text" name="id_student" value="{{old('id_student') ?? $student->id_student}}"  placeholder="VD: 22IT.B100" >
                    @error('id_student')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <input class="form-control" type="text" name="email" value="{{old('email') ?? $student->user_email}}" placeholder="VD: viethung@gmail.com" >
            @error('email')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
                </div>
              </div>
              <div class="row mb-3 ">
                <div class="col-sm-3">
                  <p class="mb-0">Di động</p>
                </div>
                <div class="col-sm-9">
                  <input class="form-control" type="text" name="mobile_number" value="{{old('mobile_number') ?? $student->user_mobile}}" placeholder="VD: 0987xxxx" >
            @error('mobile_number')
            <span style="color: red" class="text-sm">{{$message}}</span>
            @enderror
                </div>
              </div>

              <div class="row mb-3 ">
                <div class="col-sm-3">
                  <p class="mb-0">Địa chỉ</p>
                </div>
                <div class="col-sm-9">
                  <input class="form-control" type="text" name="native" value="{{old('native') ?? $student->native}}"  placeholder="VD: Thừa Thiên Huế" >
                    @error('native')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                    @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Thông tin chi tiết</h6>
                </div>
            <div class="card-body">
              <div class="row mb-3 mb-2">
                <div class="col-sm-4">
                  <p class="mb-0">Chức vụ</p>
                </div>
                <div class="col-sm-8">
                  <input class="form-control" type="text" name="position" value="{{old('position') ?? $student->position}}"  placeholder="VD: Lớp trưởng" >
                    @error('position')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4">
                  <p class="mb-0">Chuyên ngành</p>
                </div>
                <div class="col-sm-8">
                  <p class="text-dark font-weight-bold mb-0">Khoa học máy tính</p>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-sm-4">
                  <p class="mb-0">Chủ nhiệm</p>
                </div>
                <div class="col-sm-8">
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
              </div>

              <div class="row mb-3 ">
                <div class="col-sm-4">
                  <p class="mb-0">Giới tính</p>
                </div>
                <div class="col-sm-8">
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
              </div>
               <div class="row mb-3">
                <div class="col-sm-4">
                  <p class="mb-0">Ngày sinh</p>
                </div>
                <div class="col-sm-8">
                   <input class="form-control" type="date" name='date_of_birth' value="{{old('date_of_birth') ?? $student->date_of_birth}}">
                    @error('date_of_birth')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                    @enderror
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-4">
                  <p class="mb-0">Căn cước công dân</p>
                </div>
                <div class="col-sm-8">
                    <input class="form-control" type="number" name="id_card" value="{{old('id_card') ?? $student->id_card}}"  placeholder="VD: 02382183823..." >
                @error('id_card')
                <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4">
                  <p class="mb-0">Ngày cấp</p>
                </div>
                <div class="col-sm-8">
                   <input class="form-control" type="date" name='date_card' value="{{old('date_card')?? $student->date_card }}">
                    @error('date_card')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
              </div>

                <div class="row mb-3">
                <div class="col-sm-4">
                  <p class="mb-0">Dân tộc</p>
                </div>
                <div class="col-sm-8">
                  <input class="form-control" type="text" name="nation" value="{{old('nation') ?? $student->nation}}"  placeholder="VD: Kinh" >
                    @error('nation')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4">
                  <p class="mb-0">Tôn giáo</p>
                </div>
                <div class="col-sm-8">
                   <input class="form-control" type="text" name="religion" value="{{old('religion') ?? $student->religion}}"  placeholder="VD: Không" >
                    @error('religion')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
              </div>
                <div class="row mb-3">
                <div class="col-sm-4">
                  <p class="mb-0">Ngày nhập học</p>
                </div>
                <div class="col-sm-8">
                    <input class="form-control" type="date" name='date_admission' value="{{old('date_admission')?? $student->date_admission}}">
                    @error('date_admission')
                    <span style="color: red" class="text-sm">{{$message}}</span>
                @enderror
                </div>
              </div>
              <input type="hidden" name="user_id" value="{{$student->user_id}}">
              <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mx-3"> Cập nhật</button>
              <a href="{{route('students.profile')}}" class="btn btn-warning ">Trở lại</a>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chọn file để thay đổi avatar:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('students.profile.change_avatar')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name='user_id' value="{{$student->user_id}}">
            <input type="hidden" name='old_avatar' value="{{$student->user_avatar}}">
            <input type="file" name='avatar'>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
            ClassicEditor.create(document.querySelector("#editor")).catch(
                (error) => {
                    console.error(error);
                }
            );
              ClassicEditor.create(document.querySelector("#editor2")).catch(
                (error) => {
                    console.error(error);
                }
            );
        </script>
@endsection
