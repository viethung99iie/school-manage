@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
<div class="card m-4">
        <div class="card-header pb-0 d-flex">
        <div class="col-7">
            <h6>Tìm kiếm thông báo</h6>
        </div>
        </div>
        <form action="" method="GET" class="mx-3">
           <div class="row">
            <div class="col-2">
                 <label for="example-text-input" class="form-control-label ">Ngày bắt đầu </label>
                <input type="date" name="from_date" class="form-control"
                value="{{request()->from_date}}">
            </div>
             <div class="col-2">
                 <label for="example-text-input" class="form-control-label ">Ngày kết thúc</label>
                <input type="date" name="to_date" class="form-control"
                value="{{request()->to_date}}">
            </div>
            <div class="col-3">
                 <input type="text" class="opacity-0" >
                <button type="submit" class="btn btn-primary btn-block">Tìm Kiếm</button>
                <a href="{{route('students.notice_board')}}" class="btn btn-dribbble mx-2">Làm mới </a>
            </div>
           </div>
    </form>
</div>
<div class="content-wrapper">
   <section class="content">
      <div class="container-fluid">
         <div class="row">
           @foreach ($notice as $item)
                <div class="col-md-12 mb-3">
               <div class="card card-primary card-outline">
                  <div class="card-body p-0 m-4">
                     <div class="mailbox-read-info d-flex justify-content-lg-between">
                        <h5>{{$item->title}}</h5>
                        <h6><span class="mailbox-read-time text-bolder">{{date('d-m-y',strtotime($item->publish_date))}}</span>

                        </h6>
                     </div>
                     <div class="mailbox-read-message mx-2">
                       {!!$item->message!!}
                     </div>
                  </div>
               </div>
            </div>
           @endforeach
         </div>
      </div>
      <div class="row">
                    <div class="d-flex justify-content-center">{{$notice->links()}}</div>
   </section>
</div>
</div>
@endsection
