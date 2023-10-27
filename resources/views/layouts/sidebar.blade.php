  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="">
        <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1  font-weight-bold">{{Auth::user()->name}}</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class=" w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        @if(Auth::user()->user_type ===1)
        {{-- dashboard --}}
            <li class="nav-item">
                <a class="nav-link active" href="{{route('admins.dashboard')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>{{-- enddashboard --}}
        {{-- admin  --}}
            <li class="nav-item">
                <a class="nav-link " href="{{route('admins.admin.list')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Quản trị viên</span>
                </a>
            </li>{{-- endadmin  --}}
        {{-- class --}}
            <li class="nav-item">
                <a class="nav-link " href="{{route('admins.class.list')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lớp</span>
                </a>
            </li>{{-- endclass --}}
        {{-- subject --}}
            <li class="nav-item">
                    <a class="nav-link " href="{{route('admins.subject.list')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Môn học</span>
                    </a>
            </li>{{-- endsubject --}}
        {{-- assign class --}}
            <li class="nav-item">
                    <a class="nav-link " href="{{route('admins.assign_subject.list')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Đăng ký môn học</span>
                    </a>
            </li>{{-- end assign class --}}
        {{-- student  --}}
            <li class="nav-item">
                    <a class="nav-link " href="{{route('admins.student.list')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sinh viên</span>
                    </a>
            </li>{{-- end student --}}
        {{-- parent  --}}
        <li class="nav-item">
                <a class="nav-link " href="{{route('admins.parent.list')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Phụ huynh</span>
                </a>
        </li>{{-- end parent --}}

        @elseif(Auth::user()->user_type ===2)
            <li class="nav-item">
                <a class="nav-link active" href="{{route('teachers.dashboard')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
        @elseif(Auth::user()->user_type ===3)
            <li class="nav-item">
                <a class="nav-link active" href="{{route('students.dashboard')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
        @elseif(Auth::user()->user_type ===4)
            <li class="nav-item">
                <a class="nav-link active" href="{{route('parents.dashboard')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

        @endif
        {{-- profile --}}
    <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./pages/profile.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('logout')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-right-from-bracket"></i>
              <i class="ni ni-collection text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Đăng xuất</span>
          </a>
    </li>{{-- end profile --}}
      </ul>
    </div>

  </aside>
