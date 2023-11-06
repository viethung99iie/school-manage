@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
    <div class="container py-5">
      <div class="row mb-3">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
                    @if($teacher->user_avatar!=null)
                        <img src="{{ asset('image/'.$teacher->user_avatar) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    @else
                        <img src="{{ asset('image/default.png') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    @endif
              <h5 class="my-3">{{$teacher->user_name}}</h5>
              @if (!empty($teacher->position))
                  <p class="text-muted mb-1">{{$teacher->position}}</p>
              @endif
              <p class="text-muted mb-4">Chuyên ngành: Khoa học máy tính</p>
              <div class=" mb-2">
                <a href="{{ route('teachers.profile.edit', ['id'=>$teacher->id]) }}" class="btn btn-primary"><i class="fa-solid fa-user-pen mx-1" ></i>Cập nhật thông tin cá nhân</a>
                <a href=""  class="btn btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#modal-form">Thay đổi mật khẩu</a>
              </div>
            </div>
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
          <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Thông tin cơ bản</h6>
                </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Họ và tên</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-dark font-weight-bold mb-0">{{$teacher->user_name}}
                     ({{$teacher->id_teacher}})</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-dark font-weight-bold mb-0">{{$teacher->user_email}}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Di động</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-dark font-weight-bold mb-0">{{$teacher->user_mobile}}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Địa chỉ</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-dark font-weight-bold mb-0">{{$teacher->address}}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Thông tin chi tiết</h6>
                </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Chức vụ</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-dark font-weight-bold mb-0">{{$teacher->position}}</p>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Chuyên ngành</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-dark font-weight-bold mb-0">Khoa học máy tính</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Chủ nhiệm</p>
                </div>
                <div class="col-sm-9">
                   <p class="text-dark font-weight-bold mb-0">{{$teacher->class_name}}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Giới tính</p>
                </div>
                <div class="col-sm-9">
                   <p class="text-dark font-weight-bold mb-0">{{$teacher->gender}}</p>
                </div>
              </div>
               <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Ngày sinh</p>
                </div>
                <div class="col-sm-9">
                   <p class="text-dark font-weight-bold mb-0">{{$teacher->date_of_birth}}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-4">
                  <p class="mb-0">Căn cước công dân</p>
                </div>
                <div class="col-sm-8">
                   <p class="text-dark font-weight-bold mb-0">{{$teacher->id_card}}</p>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Ngày cấp</p>
                </div>
                <div class="col-sm-9">
                   <p class="text-dark font-weight-bold mb-0">{{$teacher->date_card}}</p>
                </div>
              </div>

                <div class="row mb-3">
                <div class="col-sm-4">
                  <p class="mb-0">Dân tộc</p>
                </div>
                <div class="col-sm-8">
                   <p class="text-dark font-weight-bold mb-0">{{$teacher->nation}}</p>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Tôn giáo</p>
                </div>
                <div class="col-sm-9">
                   <p class="text-dark font-weight-bold mb-0">{{$teacher->religion}}</p>
                </div>
              </div>

                <div class="row mb-3">
                <div class="col-sm-4">
                  <p class="mb-0">Bằng cấp, chứng chỉ</p>
                </div>
                <div class="col-sm-8">
                   <p class="text-dark font-weight-bold mb-0">{!!$teacher->quafilication!!}</p>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <p class="mb-0">Kinh nghiệm</p>
                </div>
                <div class="col-sm-9">
                   <p class="text-dark font-weight-bold mb-0">{!!$teacher->work_exp!!}</p>
                </div>
              </div>
                <div class="row mb-3">
                <div class="col-sm-4">
                  <p class="mb-0">Bằt đầu giảng dạy</p>
                </div>
                <div class="col-sm-8">
                   <p class="text-dark font-weight-bold mb-0">{{$teacher->date_join}}</p>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <form action="{{route('teachers.profile.change_password')}}" method="post">
        <input type="hidden" name='user_id' value='{{$teacher->user_id}}'>
        @include('model.change_password')
    </form>
@endsection
