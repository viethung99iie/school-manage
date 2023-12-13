@extends('layouts.app')
@section('title')
DashBoard
@endsection
@section('content')
 <div class="container-fluid py-4">
      <div class="row mb-3">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Tất cả học phí </p>
                    <h5 class="font-weight-bolder">
                      {{number_format($totalFee,0)}} VNĐ
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"><a href="{{route('admins.fee_collection.collect_fee')}}">Xem chi tiết</a></span>
                    </p>
                  </div>
                </div>
                 <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Học phí hôm nay</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($totalFeeToday,0)}} VNĐ
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"><a href="{{route('admins.fee_collection.collect_fee')}}">Xem chi tiết</a></span>
                    </p>
                  </div>
                </div>
                 <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold"> Số lượng các Lớp</p>
                    <h5 class="font-weight-bolder">
                      {{$totalClass}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"><a href="{{route('admins.class.list')}}">Xem chi tiết</a></span>
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle">
                    <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Môn học</p>
                    <h5 class="font-weight-bolder">
                      {{$totalSubject}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"><a href="{{route('admins.subject.list')}}">Xem chi tiết</a></span>
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-info shadow-primary text-center rounded-circle">
                    <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold"> Admin</p>
                    <h5 class="font-weight-bolder">
                      {{$totalAdmin->count()}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"><a href="{{route('admins.admin.list')}}">Xem chi tiết</a></span>
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Giảng viên</p>
                    <h5 class="font-weight-bolder">
                      {{$totalTeacher->count()}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"><a href="{{route('admins.teacher.list')}}">Xem chi tiết</a></span>
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Sinh viên</p>
                    <h5 class="font-weight-bolder">
                      {{$totalStudent->count()}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"><a href="{{route('admins.student.list')}}">Xem chi tiết</a></span>
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Phụ huynh</p>
                    <h5 class="font-weight-bolder">
                      {{$totalParent->count()}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"><a href="{{route('admins.parent.list')}}">Xem chi tiết</a></span>
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection
