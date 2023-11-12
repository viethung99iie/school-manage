@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
    @include('message')
<div class="p-2">
    @foreach ($subjects as $item )
        <div class='card mb-3'>
      <div class="row">
         <div class="col-12">
            <div class="card mb-4">
               <div class="card-header pb-0">
                  <h6>{{$item['name']}}</h6>
               </div>
               <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                     <table class="table table-responsive table-striped">
                        <thead >
                           <tr class="">
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ">Ngày</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Thời gian bắt đầu</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">thời gian kết thúc</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Phòng học</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2"></th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($item['weeks'] as $itemW)
                                <tr>
                                <td>
                                    <h5 class="mb-0 text-dark text-sm px-4">{{$itemW['week_name']}}</h5>
                                </td>
                                <td>
                                     <input type="time" value="{{$itemW['start_time']}}" class="form-control" disabled>
                                </td>
                                <td>
                                    <input type="time" value="{{$itemW['end_time']}}" class="form-control" disabled>
                                </td>
                                <td style="width:250px;">
                                    <input type="text" value="{{$itemW['room']}}"  class="form-control" disabled>
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
    @endforeach
</div>
@endsection
