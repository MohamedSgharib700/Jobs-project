@extends('web.layout')
@section('content')

    <section class="header-setting">
        <div class="container">
            <div class="set-header">
                <h2>{{trans('setting')}}</h2>
            </div>
        </div>
    </section>
    <!-- start personal section -->
    <section class="setting">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form action="">
                        <div class="noti-box">
                            <h2>{{trans('notifications')}}</h2>
                            <p>{{trans('notifications_manage')}}</p>
                            <div class="noti-now">
                                <label class="check-label">
                                    <input type="checkbox" name="active"
                                           id="active"
                                           data-model="{{get_class($seeker)}}"
                                           data-id="{{ $seeker->id }}"
                                           value="{{ $seeker->active }}"
                                           {{ $seeker->active == 1 ? 'checked' : '' }} class="custom-switch-input">
                                    <span>{{trans('receive_notifications')}}</span>
                                </label>
                            </div>
                        </div>
                        <div class="email-content">
                            <h2>{{trans('email')}}</h2>
                            <p>{{trans('your_email')}}</p>
                            <a href="" class="email-pop" data-toggle="modal" data-target="#exampleModalCenter5">{{trans('change')}}</a>
                            <input class="input" type="text"  value="{{$seeker->email}}" placeholder="email@email.com">
                        </div>
                        <div class="pass-content">
                            <h2>{{trans('password')}}</h2>
                            <p>{{trans('enter_your_password')}}</p>
                            <a href="" class="pass-pop" data-toggle="modal" data-target="#exampleModalCenter6">{{trans('change')}}</a>
                            <input class="input" type="password"  value="" placeholder="*******">
                        </div>
                        <div class="social-set">
                            <h2>{{trans('social_accounts')}}</h2>
                            <p>{{trans('connect_to_social_accounts')}}</p>
                            <button type="button" class="face-btn">{{trans('facebook')}}<span>{{trans('dis_connect')}}</span></button>
                            <button type="button" class="google-btn">{{trans('google')}}<span>{{trans('connect')}}</span></button>
                        </div>
                        <div class="delete-acc">
                            <h2>{{trans('delete_account')}}</h2>
                            <p>{{trans('connect_to_social_accounts')}}</p>
                            <button type="button" class="delete-btn" data-toggle="modal" data-target="#exampleModalCenter7">{{trans('delete_account')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- end personal section -->

    <div class="modal fade email-model" id="exampleModalCenter5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-12 mx-auto">
                        <div class="alert alert-danger" id="devError" >
                            <span id="nameErrMsg" class="error"> {{trans('input_required')}} </span>
                        </div>
                        <div class="alert alert-success" id="successMessage"  style="color: #ffffff;background-color: #aab2de; border-color: #aab2de;"role="alert">
                              {{trans('changed')}}
                        </div>
                        <form id="change_email" action="" data-route="{{route('api.seeker.change.email',['seeker' => $seeker])}}"  method="post">
                            @method('Put')
                            @csrf
                            <div class="card-header">
                            <h2>{{trans('change_account')}}</h2>
                            <p>{{trans('enter_your_email')}}</p>
                            <input type="text" name="email" id="new_email" value="{{$seeker->email}}" placeholder="{{trans('new_account')}}">

                            <button type="submit"  class="done-btn">{{trans('change')}}</button>

                            </div>

                        </form>



                    </div>
                </div>

            </div>




        </div>
    </div>

    <div class="modal fade pass-model" id="exampleModalCenter6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-12 mx-auto">
                        <div class="alert alert-danger" id="devErrorPassword" >
                            <span id="devErrorPassword" class="error"> {{trans('input_required')}} </span>
                        </div>
                        <div class="alert alert-success" id="successMessagePassword"  style="color: #ffffff;background-color: #aab2de; border-color: #aab2de;"role="alert">
                            {{trans('changed')}}
                        </div>
                        @if(session()->has('error'))
                            <div class="alert alert-success alert-has-icon alert-dismissible show fade">
                                <div class="alert-icon"><i class="ion ion-ios-lightbulb-outline"></i></div>
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>×</span>
                                    </button>
                                    <div class="alert-title">{{trans('success')}}</div>
                                    {{ session('error') }}
                                </div>
                            </div>
                        @endif
                        <form id="change_password" action="" data-route="{{route('api.seeker.change.password',['seeker' => $seeker])}}" method="post">
                            @method('Put')
                            @csrf
                            <h2>{{trans('change_password')}}</h2>
                            <p>{{trans('follow_steps')}}</p>
                            <input type="password" name="old_password" id="old_password"  placeholder="{{trans('old_password')}}">
                            <input type="password" id="password" name="password" placeholder="{{trans('new_password')}}">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="{{trans('confirm_password')}}">

                            <button type="submit" class="done-btn" >{{trans('change')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade delete-acc" id="exampleModalCenter7" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-12 mx-auto">
                        <form action="{{ route('web.seekers.destroy', ['seeker' => $seeker]) }}" method="Post">
                            @method('DELETE')
                            @csrf
                            <h2>{{trans('account_delete')}}</h2>
                            <p>{{trans('do_you_need_account_delete')}}</p>
                            <div class="row">
                                <div class="col-md-7 col-7">
                                    <button class="back-btn" href="#">{{trans('return')}}</button>
                                </div>
                                <div class="col-md-5 col-5">
                                    <button type="submit" class="back-btn"> {{trans('delete')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade exit-model" id="exampleModalCenter8" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-12 mx-auto">
                        <form action="">
                            <h2>{{trans('logout_account')}}</h2>
                            <p>{{trans('do_you_need_logout')}}</p>
                            <div class="row">
                                <div class="col-md-7 col-7">
                                    <button class="back-btn" href="#">{{trans('return')}}</button>
                                </div>
                                <div class="col-md-5 col-5">
                                    <a href="">{{trans('logout_account')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('scripts')

    <script type="text/javascript">
        $("#devError").hide();
        $("#successMessage").hide();
        $("#devErrorPassword").hide();
        $("#successMessagePassword").hide();

        $(document).ready(function () {
            $("#change_email").submit(function (e) {
                e.preventDefault();
                var url = $('#change_email').data('route');

                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        'email': $('#new_email').val(),
                    },

                    success: function (data) {
                        $("#devError").hide();
                        $("#successMessage").show();
                    },
                    error: function () {
                        $("#successMessage").hide();
                        $("#devError").show();
                    }
                });
            });

        });


         $(document).ready(function () {
            $("#change_password").submit(function (e) {
                e.preventDefault();
                var url = $('#change_password').data('route');

                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        'password': $('#password').val(),
                    },

                    success: function (data) {
                        $("#devErrorPassword").hide();
                        $("#successMessagePassword").show();
                    },
                    error: function () {
                        $("#successMessagePassword").hide();
                        $("#devErrorPassword").show();
                    }
                });
            });

         });

        $(document).ready(function () {
            $("input[id='active']").click(function () {
                var url = '{{ route("api.model.active") }}';

                var defaultRadioValue = $(this).val();
                $(this).val(0);
                if (defaultRadioValue == 0) {
                    $(this).val(1);
                }

                var dataModel = $(this).attr('data-model');
                var dataId = $(this).attr('data-id');

                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}',
                        'active': $(this).val(),
                        'modelName': dataModel,
                        'modelId': dataId
                    },

                    success: function (data) {
                        var alertMessage = '{{trans('disabled_successfully')}}';

                        if (data.active == 1) {
                            alertMessage = '{{trans('active_successfully')}}';
                        }
                        toastr.success(alertMessage, '{{trans("success")}}', {
                            positionClass: "toast-bottom-right",
                            closeButton: true
                        })
                    },
                    error: function () {
                    }
                });
            });

        });




    </script>



@endsection
