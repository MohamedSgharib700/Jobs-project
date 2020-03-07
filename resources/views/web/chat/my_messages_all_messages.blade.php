
                             @foreach(@$messages as $message)
                                      
                              @if(auth()->id() == $message->user_id)
                                    <div class="user-massege">
                                        <p>{{ $message->message }}
                                        </p>
                                    </div>
                                 @else
                         <div class="clint-massege">
                                        <p>{{ $message->message }}</p>
                                    </div>
                                    @endif
                             @endforeach