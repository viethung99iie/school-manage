@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
@include('message')
<div class="p-2">
    <div class="card p-2 my-2">
            <h4 >Kết quả học tập : {{$student_name}}</h4>
    </div>
   @foreach ($getRecord as $value )
   <div class='card mb-3'>
      <div class="row">
         <div class="col-12">
            <div class="card mb-4">
               <div class="card-header pb-0">
                  <h6>{{$value['name']}}</h6>
               </div>
               <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                     <table class="table table-responsive table-striped">
                        <thead >
                           <tr class="">
                              <th class="text-dark text-xs font-weight-bolder opacity-9">Môn học</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm CC</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm bài tập</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm giữa kì</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm cuối kì</th>
                              <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm T10</th>
                               <th class="text-dark text-xs font-weight-bolder opacity-9 ps-2">Điểm chữ</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($value['subject'] as $item)
                           @php
                                $word_mark ='';
                                $total = ($item['class_work']*0.1 + $item['home_work']*0.2 + $item['test_work']*0.2 + $item['exam']*0.5);
                                if($total<=10 && $total>=8.5){
                                    $word_mark ='A';
                                }elseif($total<=8.5 && $total>=7){
                                    $word_mark ='B';
                                }elseif($total<=7 && $total>=5){
                                    $word_mark ='C';
                                }elseif($total<=5 && $total>=3){
                                    $word_mark ='D';
                                }else{
                                    $word_mark ='F';
                                }
                            @endphp
                           <tr>
                              <td>
                                 <div class="d-flex px-2">
                                    <div class="my-auto">
                                       <h5 class="mb-0 text-sm">{{$item['subject_name']}}</h5>
                                    </div>
                                 </div>
                              </td>
                              <td>
                                 <input type="text" value="{{$item['class_work']}}" class="form-control" disabled>
                              </td>
                              <td>
                                 <input type="text" value="{{$item['home_work']}}" class="form-control" disabled>
                              </td>
                              <td>
                                 <input type="text" value="{{$item['test_work']}}" class="form-control" disabled>
                              </td>
                              <td>
                                 <input type="text" value="{{$item['exam']}}" class="form-control" disabled>
                              </td>
                              <td>
                                 <input type="text" value="{{$total}}" class="form-control" disabled>
                              </td>
                              <td>
                                 <input type="text" value="{{$word_mark}}" class="form-control" disabled>
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
