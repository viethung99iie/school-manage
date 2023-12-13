@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
@include('message')
<div class="p-2">
   <div class='card mb-3'>
      <div class="row">
         <div class="col-12">
            <div class="card mb-4">
               <div class="card-header pb-0">
                  <h6>{{$title}}</h6>
               </div>
               <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                     <table class="table table-responsive table-striped">
                        <thead >
                           <tr class="">
                              <th class="text-dark text-xs font-weight-bolder opacity-9">Kì học</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Học phí</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Trạng thái</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Ngày thanh toán</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Hành động</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($fee as $item)
                            <form action="{{route('students.paypal_student')}}" method="post">
                               @csrf
                                <tr>
                                    <td>
                                 <div class="d-flex px-2">
                                    <div class="my-auto">
                                       <h5 class="mb-0 text-sm">{{$item['exam_name']}}</h5>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                    <span class="badge badge-dot me-2">
                                    <span class="text-secondary text-xs" >{{number_format($item['amount'],0)}} VNĐ</span>
                                    <input type="hidden" name='amount' value="{{$item['amount']}}">
                                    <input type="hidden" name='exam_id' value="{{$item['exam_id']}}">
                                    <input type="hidden" name='class_id' value="{{$item['class_id']}}">
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-dot me-2">
                                        @if ($item['status'] == 1)
                                        <span class="text-success text-xs">Đã thanh toán</span>
                                    @else
                                         <span class="text-secondary text-xs">Chưa thanh toán</span>
                                    @endif

                                    </span>
                                </td>
                                <td>
                                    @if($item['payment_date'] !='')
                                    <span class="badge badge-dot me-2">
                                    <span class="text-secondary text-xs" >{{ date('H:i:s d/m/Y', strtotime($item['payment_date']));}}</span>

                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item['status'] == 1)
                                    <span class="badge badge-dot me-2">
                                        <span class="text-success text-xs">Đã thanh toán</span>
                                    </span>
                                    @else
                                       <button type="submit" class="btn btn-success">Thanh toán Paypal</button>
                                       </form>
                                    @endif

                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
