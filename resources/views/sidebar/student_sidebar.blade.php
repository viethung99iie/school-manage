
             <li class="nav-item">
                <a class="nav-link @if (Request::segment(2)=='my-subject')
            active
            @endif" href="{{route('students.my_subject')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-copy-04 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Môn học</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2)=='my_calendar')
            active
            @endif" href="{{route('students.my_calendar')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-calendar-grid-58 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Thời khóa biểu</span>
                </a>
            </li>
            <li class="nav-item @if (Request::segment(2)=='class_timetable')
            active
            @endif">
                <a class="nav-link" href="{{route('students.class_timetable')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-calendar-grid-58 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lịck học từng môn</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2)=='exam_timetable')
            active
            @endif" href="{{route('students.exam_timetable')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-calendar-grid-58 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lịch thi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2)=='exam_result')
            active
            @endif" href="{{route('students.exam_result')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-book-bookmark text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Kết quả học tập</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2)=='notice_board')
            active
            @endif" href="{{route('students.notice_board')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-chat-round text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Thông báo</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2)=='fee_collect')
            active
            @endif" href="{{route('students.fee_collect')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-money-coins text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Học phí của tôi</span>
                </a>
            </li>

        {{-- profile --}}
            <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
            <a class="nav-link " href="{{route('students.profile')}}">
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
