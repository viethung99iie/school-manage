<div class="card-header shadow-lg">
              @include('chat.header')
            </div>
               @include('chat._chat')
            <div class="card-footer d-block">
               <form action="" method="post" id="submit_message" class="align-items-center">
                @csrf
                <input type="hidden" value="{{$receiver->id}}" name="receiver_id">
                  <div class="d-flex">
                     <div class="input-group">
                    <textarea
                            name="message"
                            required
                            type="text"
                            class="form-control emojionearea"
                            placeholder="Gửi tin nhắn"
                            aria-label="Message example input"
                            id='clearMessage'></textarea>
                     </div>
                     <button type="submit" class="btn bg-gradient-primary  mx-2 " style="height: 50px !important;">
                     <i class="ni ni-send " style="font-size: 1rem"></i>
                     </button>
                  </div>
               </form>
            </div>
