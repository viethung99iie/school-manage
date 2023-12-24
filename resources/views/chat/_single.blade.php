@foreach ($getChat as $item)
            @if ($item->sender_id != Auth::user()->id)
            <div class="row justify-content-start mb-4">
                  <div class="col-auto">
                     <div class="card ">
                        <div class="card-body py-2 px-3">
                           <p class="mb-1">
                              {{$item->message}}
                           </p>
                           <div class="d-flex align-items-center text-sm opacity-6">
                              <i class="ni ni-check-bold text-sm me-1"></i>
                              <small>{{Carbon\Carbon::parse($item->created_date)->diffForHumans()}}</small>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            @else
            <div class="row justify-content-end text-right mb-4">
                  <div class="col-auto">
                     <div class="card bg-gray-200">
                        <div class="card-body py-2 px-3">
                           <p class="mb-1">
                               {{$item->message}}
                           </p>
                           <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                              <i class="ni ni-check-bold text-sm me-1"></i>
                              <small>{{Carbon\Carbon::parse($item->created_date)->diffForHumans()}}</small>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            @endif

@endforeach
