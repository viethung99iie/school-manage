      <style>
        .navbar-vertical .navbar-brand>img, .navbar-vertical .navbar-brand-img {
    max-height: 3rem;
}
      </style>
      <aside
      class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
      id="sidenav-main"
    >
      <div class="sidenav-header">
        <i
          class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
          aria-hidden="true"
          id="iconSidenav"
        ></i>
        <a
          class="navbar-brand m-0 "
          href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
          target="_blank"
        >
            <img
            src="{{ asset('image/'.Auth::user()->profile_pic) }}"
            class="navbar-brand-img h-100"
            alt="main_logo"
          />
          <span class="ms-1 font-weight-bold">{{Auth::user()->name}}</span>
        </a>
      </div>
      <hr class="horizontal dark mt-0" />
      <div class=" w-auto" >
        <ul class="navbar-nav">
             @if(Auth::user()->user_type ===1)
                    @include('sidebar.admin_sidebar')
             @elseif(Auth::user()->user_type ===2)
                    @include('sidebar.teacher_sidebar')
            @elseif(Auth::user()->user_type ===3)
                @include('sidebar.student_sidebar')
            @elseif(Auth::user()->user_type ===4)
                @include('sidebar.parent_sidebar')
        @endif
        </ul>
      </div>
    </aside>
