 <div class="row">
                  <div class="col-lg-10 col-8">
                     <div class="d-flex align-items-center">
                        @php
                            if(!empty($receiver->profile_pic) ||$receiver->profile_pic != null )
                            {
                                $avatar = $receiver->profile_pic;
                            }else{
                                $avatar = 'user.jpg';
                            }
                        @endphp
                        <img alt="Image" src="{{asset('image/'.$avatar)}}" class="avatar">
                        <div class="ms-3">
                           <h6 class="mb-0 d-block">{{$receiver->name}}</h6>
                           <span class="text-sm text-dark opacity-8">last seen: {{Carbon\Carbon::parse($receiver->updated_at)->diffForHumans()}}</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-1 col-2 my-auto pe-0">
                     <button class="btn btn-icon-only shadow-none text-dark mb-0 me-3 me-sm-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title data-bs-original-title="Video call">
                     <i class="ni ni-camera-compact"></i>
                     </button>
                  </div>
                  <div class="col-lg-1 col-2 my-auto ps-0">
                     <div class="dropdown">
                        <button class="btn btn-icon-only shadow-none text-dark mb-0" type="button" data-bs-toggle="dropdown">
                        <i class="ni ni-settings"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end me-sm-n2 p-2" aria-labelledby="chatmsg">
                           <li>
                              <a class="dropdown-item border-radius-md" href="javascript:;">
                              Profile
                              </a>
                           </li>
                           <li>
                              <a class="dropdown-item border-radius-md" href="javascript:;">
                              Mute conversation
                              </a>
                           </li>
                           <li>
                              <a class="dropdown-item border-radius-md" href="javascript:;">
                              Block
                              </a>
                           </li>
                           <li>
                              <a class="dropdown-item border-radius-md" href="javascript:;">
                              Clear chat
                              </a>
                           </li>
                           <li>
                              <a class="dropdown-item border-radius-md text-danger" href="javascript:;">
                              Delete chat
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
