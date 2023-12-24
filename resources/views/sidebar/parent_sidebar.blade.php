            <li class="nav-item">
            <a class="nav-link @if (Request::segment(1)=='my-student')
            active
            @endif" href="{{ route('parents.my-student', ['id'=>Auth::user()->parent_id]) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-02 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Con của tôi</span>
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="{{route('parents.notice_board')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-chat-round  text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Thông báo</span>
                </a>
            </li>
        {{-- profile --}}
            <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
            <a class="nav-link @if (Request::segment(2)=='profile')
            active
            @endif" href="{{route('parents.profile')}}">
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
