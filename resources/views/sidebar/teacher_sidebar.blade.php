            {{-- assign class --}}
            <li class="nav-item ">
                    <a class="nav-link @if (Request::segment(2)=='my_class_subject')
            active
            @endif" href="{{route('teachers.class-subject')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 me-sm-1 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Lớp giảng dạy</span>
                    </a>
            </li>{{-- end class teacher --}}
            {{-- exam   --}}
            <li class="nav-item ">
                    <a class="nav-link @if (Request::segment(2)=='exam_timetable')
            active
            @endif" href="{{route('teachers.exam_timetable')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 me-sm-1 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Lịch thi</span>
                    </a>
            </li>{{-- end exam --}}
            {{-- calendar   --}}
            <li class="nav-item ">
                    <a class="nav-link @if (Request::segment(2)=='calendar')
            active
            @endif" href="{{route('teachers.calendar')}}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 me-sm-1 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Lịch giảng dạy</span>
                    </a>
            </li>{{-- end calendar --}}
            <li class="nav-item">
   <a data-bs-toggle="collapse" href="#authExamples" class="nav-link @if (
    Request::segment(1)=='attendance' || Request::segment(2)=='student')
active @endif" aria-controls="authExamples" role="button" aria-expanded="false">
      <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
         <i class="ni ni-archive-2 text-primary text-sm opacity-10"></i>
      </div>
      <span class="nav-link-text ms-1">Điểm danh </span>
   </a>
   <div class="collapse @if (
    Request::segment(1)=='attendance'|| Request::segment(2)=='student')
show @endif" id="authExamples">
      <ul class="nav ms-4">
         {{-- điểm danh học sinh  --}}
            <li class="nav-item ">
                <a class="nav-link @if (Request::segment(2)=='student')
                active
                @endif" href="{{route('teachers.attendance.student')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-badge me-sm-1 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Điểm danh sinh viên</span>
                </a>
            </li>{{-- end điểm danh học sinh --}}
            {{-- báo cáo điểm danh  --}}
            <li class="nav-item ">
                <a class="nav-link @if (Request::segment(2)=='repost')
                active
                @endif" href="{{route('teachers.attendance.repost')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-badge me-sm-1 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Báo cáo điểm danh</span>
                </a>
            </li>{{-- end báo cáo điểm danh  --}}
      </ul>
   </div>
</li>
{{-- end điểm danh  --}}
            {{-- điểm thi --}}
            <li class="nav-item ">
                <a class="nav-link @if (Request::segment(2)=='mark_register')
                active
                @endif" href="{{route('teachers.mark_register')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni    ni-book-bookmark me-sm-1 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Nhập điểm thi</span>
                </a>
            </li>{{-- điểm thi --}}
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2)=='notice_board')
                active
                @endif" href="{{route('teachers.notice_board')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-chat-round text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Thông báo</span>
                </a>
            </li>
        {{-- profile --}}
            <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
            <a class="nav-link " href="{{route('teachers.profile')}}">
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
