        {{-- dashboard --}}
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2)=='dashboard')
            active
            @endif" href="{{route('admins.dashboard')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>{{-- enddashboard --}}
        {{-- admin  --}}
        <li class="nav-item">
            <a class="nav-link @if (Request::segment(2)=='admin')
            active
            @endif" href="{{route('admins.admin.list')}}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Quản trị viên </span>
            </a>
        </li>{{-- endadmin  --}}
        {{-- teacher  --}}
        <li class="nav-item">
            <a class="nav-link  @if (Request::segment(2)=='teacher')
            active
            @endif" href="{{route('admins.teacher.list')}}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Giảng Viên</span>
            </a>
        </li>{{-- endteacher  --}}
        {{-- student  --}}
            <li class="nav-item ">
                    <a class="nav-link @if (Request::segment(2)=='student')
            active
            @endif" href="{{route('admins.student.list')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sinh viên</span>
                    </a>
            </li>{{-- end student --}}
        {{-- parent  --}}
        <li class="nav-item ">
                <a class="nav-link @if (Request::segment(2)=='parent')
            active
            @endif" href="{{route('admins.parent.list')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Phụ huynh</span>
                </a>
        </li>{{-- end parent --}}
<li class="nav-item">
   <a data-bs-toggle="collapse" href="#applicationsExamples" class="nav-link @if (
    Request::segment(2)=='class'||
    Request::segment(2)=='subject'||
    Request::segment(2)=='assign_subject'||
    Request::segment(2)=='class_teacher'||
    Request::segment(2)=='class_timetable')
active @endif " aria-controls="applicationsExamples" role="button" aria-expanded="false">
      <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
         <i class="fa-solid fa-book text-primary text-sm opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Học tập</span>
   </a>
   <div class="collapse @if (
    Request::segment(2)=='class'||
    Request::segment(2)=='subject'||
    Request::segment(2)=='assign_subject'||
    Request::segment(2)=='class_teacher'||
    Request::segment(2)=='class_timetable')
show @endif" id="applicationsExamples">
      <ul class="nav ms-4">
        {{-- class --}}
            <li class="nav-item ">
                <a class="nav-link @if (Request::segment(2)=='class')
                active
                @endif" href="{{route('admins.class.list')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lớp</span>
                </a>
            </li>{{-- endclass --}}
            {{-- subject --}}
            <li class="nav-item ">
                    <a class="nav-link @if (Request::segment(2)=='subject')
            active
            @endif" href="{{route('admins.subject.list')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Môn học</span>
                    </a>
            </li>{{-- endsubject --}}
            {{-- assign subject --}}
            <li class="nav-item ">
                    <a class="nav-link @if (Request::segment(2)=='assign_subject')
            active
            @endif" href="{{route('admins.assign_subject.list')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Đăng ký môn học</span>
                    </a>
            </li>{{-- class subject --}}
            {{-- class time table --}}
            <li class="nav-item ">
                    <a class="nav-link @if (Request::segment(2)=='class_timetable')
            active
            @endif" href="{{route('admins.class_timetable.list')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Đăng ký lịch học</span>
                    </a>
            </li>{{-- class subject --}}
            {{-- assign teacher --}}
            <li class="nav-item ">
                    <a class="nav-link @if (Request::segment(2)=='class_teacher')
            active
            @endif" href="{{route('admins.class_teacher.list')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Giáo viên chủ nhiệm</span>
                    </a>
            </li>{{-- end class teacher --}}
      </ul>
   </div>
</li>
<li class="nav-item">
   <a data-bs-toggle="collapse" href="#ecommerceExamples" class="nav-link @if (
    Request::segment(1)=='examinations')
active @endif" aria-controls="ecommerceExamples" role="button" aria-expanded="false">
      <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
         <i class="ni ni-archive-2 text-success text-sm opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Thi cử</span>
   </a>
   <div class="collapse @if (
    Request::segment(1)=='examinations')
show @endif" id="ecommerceExamples">
   <ul class="nav ms-4">
            {{-- exam --}}
            <li class="nav-item ">
                <a class="nav-link @if (Request::segment(2)=='exam')
                active
                @endif" href="{{route('admins.examinations.exam.list')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Kì thi</span>
                </a>
            </li>{{-- endexam --}}
            {{-- lịch thi --}}
            <li class="nav-item ">
                <a class="nav-link @if (Request::segment(2)=='exam')
                active
                @endif" href="{{route('admins.examinations.schedule')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lịch thi</span>
                </a>
            </li>{{-- lịch thi --}}
            {{-- lịch thi --}}
            <li class="nav-item ">
                <a class="nav-link @if (Request::segment(2)=='mark_register')
                active
                @endif" href="{{route('admins.examinations.mark_register')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user me-sm-1 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Nhập điểm thi</span>
                </a>
            </li>{{-- lịch thi --}}
 </div>
</li>
        {{-- profile --}}
        <li class="nav-item mt-3 ">
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
            </li>
            {{-- end profile --}}
