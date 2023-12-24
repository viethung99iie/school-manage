<style>
    .message-number{
        padding: 4px;
        border-radius: 20px;
        font-size: 13px;
        position: absolute;
        line-height: 10px;
    }
    .active{
        background-color: #5e72e4;
        border-radius: 10px;
        color: white;
    }
    .active span ,
     .active  p {
        color: white !important;
    }
</style>

   @if (!empty($getUser))
        @foreach ($getUser as $item)
                    <div class="d-flex p-3 getChatWindows " id="{{$item['user_id']}} " user_type = {{$item['user_type']}}' >
                        @if ($item['profile_pic']!=null)
                            <img alt="Image" src="{{asset('image/'.$item['profile_pic'])}}" class="avatar shadow">
                        @else
                            <img alt="Image" src="https://th.bing.com/th/id/OIP.srNFFzORAaERcWvhwgPzVAHaHa?rs=1&pid=ImgDetMain" class="avatar shadow">
                        @endif
                        <div class="ms-3" >
                        <span class="mb-0 font-weight-bolder">{{$item['name']}}</span>
                        @if ($item['messageCount']>0)
                            <span id="clearMessage{{$item['user_id']}}" class="message-number bg-success">{{$item['messageCount']}}</span>
                        @endif
                        <p class="text-muted text-xs mb-2">{{Carbon\Carbon::parse($item['created_date'])->diffForHumans()}}</p>
                        <span class="text-muted text-sm col-11 p-0 text-truncate d-block">{{$item['message']}}</span>
                        </div>
                    </div>
           @endforeach
   @endif

