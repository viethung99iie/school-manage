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
        {{-- teacher  --}}
        <li class="nav-item">
            <a class="nav-link " href="{{route('admins.teacher.list')}}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Giảng Viên</span>
            </a>
        </li>{{-- endteacher  --}}
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
