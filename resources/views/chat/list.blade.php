@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('emojionearea/emojionearea.min.css')}}">
@endsection
@section('content')
<style>
.input-group-text{
    border-radius: 10px 0 0 10px;
}
</style>
   <div class="row py-2">
      <div class="col-lg-4 col-md-5 col-12">
         <div class="card blur shadow-blur max-height-vh-80 overflow-auto overflow-x-hidden mb-5 mb-lg-0">
            <div class="card-header p-3">
               <h6>Liên hệ</h6>
               <div class="input-group">
                <div class="input-group-prepend ">
                    <span class="input-group-text p-3" id="getSearchUser"><i class="fa-solid fa-magnifying-glass"></i></span>
                </div>
               <input type="name" class="form-control" id="getSearch" placeholder="Tìm kiếm" aria-label="Email">
            </div>
            <input type="hidden" class="form-control" id="getReceiverDynamicID" value="{{$receiver_id}}">
            </div>

                <div class="card-body p-2" id='getSearchUserDynamic'>
                 @include('chat._user')
                </div>
         </div>
      </div>
      <div class="col-lg-8 col-md-7 col-12" >
         <div class="card blur shadow-blur max-height-vh-80" id="getChatMessageAll">
                @if (!empty($receiver))
                        @include('chat._message')
                @else
                @endif
         </div>
      </div>
   </div>
@endsection

@section('javascript')
<script src="{{asset('emojionearea/emojionearea.min.js')}}"></script>
<script>
    $('body').delegate('.getChatWindows','click',function(e){
    e.preventDefault();
    var receiver_id = $(this).attr('id');
    var user_type = $(this).attr('user_type');
    $('#getReceiverDynamicID').val(receiver_id);
    $.ajax({
        type: 'POST',
        url: '{{route('chat.get_chat_window')}}',
        data: {
            'receiver_id' : receiver_id,
                'user_type' : user_type,
            '_token' : '{{ csrf_token() }}',
        },
        dataType: 'json',
        success: function(data){
            $('#clearMessage'+receiver_id).hide();
            $('#getChatMessageAll').html(data.success);
            window.history.pushState("","","{{ url('chat?user_type=')}}"+data.user_type +"&receiver_id="+data.receiver_id);
                scrollDown();
        },
        error: function(data){},
    });
    });

     $('body').delegate('#getSearchUser','click',function(e){
        var search = $('#getSearch').val();
        var receiver_id = $('#getReceiverDynamicID').val();
        $.ajax({
            type: 'POST',
            url: '{{route('chat.get_chat_search_user')}}',
            data: {
                'receiver_id' : receiver_id,
                'search' : search,
                '_token' : '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(data){
                $('#getSearchUserDynamic').html(data.success);
            },
            error: function(data){},
        });
     });

    $('body').delegate('#submit_message','keydown',function(e){
          if (e.keyCode === 13) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{route('chat.submit_message')}}',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data){
                $('#appendMessage').append(data.success);
                $('#clearMessage').val('');
                scrollDown();
            },
            error: function(data){},
        });
        }
    });
    $('body').delegate('#submit_message','submit',function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{route('chat.submit_message')}}',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data){
                $('#appendMessage').append(data.success);
                $('#clearMessage').val('');
                scrollDown();
            },
            error: function(data){},
        });
    });
    function scrollDown(){
        $('#appendMessage').animate({scrollTop: $('#appendMessage').prop('scrollHeight')+30000},500);
    }
    scrollDown();
</script>
@endsection
