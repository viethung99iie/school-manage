<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    NvH - Đăng nhập
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset("assets/css/nucleo-icons.css")}}" rel="stylesheet" />
  <link href="{{asset("assets/css/nucleo-svg.css")}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset("assets/css/nucleo-svg.css")}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset("assets/css/argon-dashboard.css?v=2.0.4")}}" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h2 class="font-weight-bolder text-center">Đăng nhập</h2>
                  <p class="mb-0">Nhập email và mật khẩu để đăng nhập.</p>
                </div>
                <div class="card-body">
                  {{-- form login --}}
                  <form role="form" action="{{route('authlogin')}}" method="POST" >
                    @csrf
                    @include('message')
                    <div class="mb-3">
                      <input type="text" class="form-control form-control-lg" placeholder="Email" name="email" value="{{old('email')}}">
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" placeholder="Mật khẩu" aria-label="Password" name="password" value="{{old('password')}}">
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                      <label class="form-check-label" for="rememberMe">Nhớ mật khẩu</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Đăng nhập</button>
                    </div>
                  </form>
                  {{-- end form login --}}
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Bạn chưa có tài khoản?
                    <a href="javascript:;" class="text-primary text-gradient font-weight-bold">Đăng ký</a>
                  </p>
                  <a href="{{route('forgot')}}" class="text-primary text-gradient font-weight-bold">Quên mật khẩu</a>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                {{-- <h4 class="mt-5 text-white font-weight-bolder position-relative">"NVH Management"</h4>
                <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="{{asset("assets/js/core/popper.min.js")}}"></script>
  <script src="{{asset("assets/js/core/bootstrap.min.js")}}"></script>
  <script src="{{asset("assets/js/plugins/perfect-scrollbar.min.js")}}"></script>
  <script src="{{asset("assets/js/plugins/smooth-scrollbar.min.js")}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset("assets/js/argon-dashboard.min.js?v=2.0.4")}}"></script>
</body>

</html>
