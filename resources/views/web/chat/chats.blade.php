@extends('web.layout')

@section('content')
    <!-- start personal section -->
    <section class="js-profile">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="mymenu">
                        <div class="row">
                            <div class="col-md-4 col-4">
                                <div class="header-profile">
                                    <a href="./jsprofile.html">{{trans('personal_data')}}</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-4">
                                <div class="header-profile">
                                    <a href="./jsmasseage.html" class="active">{{trans('messages')}}</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-4">
                                <div class="header-profile">
                                    <a href="./jsnotification.html">{{trans('notifications')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- start massege -->
                    <div class="chat-box">
                        <div class="row">
                            <div class="col-md-4 col-4 p-1">
                   
                           <?php $focus_class = "active" ?>
                                <div class="inbox-massege">
                                    @foreach(@$chat_channels as $value)
                                    <a class="user-name {{ $focus_class }} user-box-chat box-ms " id="{{$value->chat_id ."_".$value->id}}">
                                        <h2>{{$value->first_name}} {{$value->last_name}}<span>{{$value->message_date}}</span></h2>
                                        <!-- <p>هناك حقيقة مثبتة منذ زمن مثبتة</p> -->
                                    </a>
                               @php $focus_class = ""; @endphp
                            @endforeach
                                   
                                </div>

                            </div>
                            <div class="col-md-8 col-8 p-1">
                                <div class="chat content-chat">
                                    @include("web.chat.my_messages_all_messages")
                                </div>
                            {!! Form::open(['id'=>"send_new_message"]) !!}
                            @if($new_receiver != null)
                            {!! Form::hidden("user_id",@$focused_user->id ,["id"=>"send_messaged_input_chat_id"]) !!}
                            @else
                            {!! Form::hidden("chat_id",@$focused_user->chat_id ,["id"=>"send_messaged_input_chat_id"]) !!}
                            @endif
                                <div class="send-massege">
                                    <textarea id="msg_text" name="message" placeholder="{{trans('leave_your_message')}}"></textarea>
                                    <div class="send-img">
                                        <img src="{{url('')}}/assets/web/img/Icons/send.png" alt=""id="btn_send_message" alt="">
                                    </div>
                                </div>
                           {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                    <!-- end massege -->
                </div>
                <div class="col-md-3">
                    <div class="statics">
                        <div class="static-header">
                            <h2>{{trans('statistics')}}</h2>
                        </div>
                        <div class="static-box">
                            <h3>{{trans('seekers')}}</h3>
                            <p>{{$seekersCount}}</p>
                            <h3>{{trans('employers')}}</h3>
                            <p>{{$employersCount}}</p>
                            <h3>{{trans('done_jobs')}}</h3>
                            <p>{{count($chat_channels)}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end personal section -->

 @stop
