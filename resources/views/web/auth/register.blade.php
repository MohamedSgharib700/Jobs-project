@extends('web.layout')

@section('content')
    <section class="signup">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <form action="{{ route('web.auth.register')}}" method="POST" class="sign-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-9 col-md-10 mx-auto">
                                <h2>{{trans('new_account')}}</h2>
                                <p>{{trans('new_generation_of_recruitment_sites_join_us_now')}}</p>
                                <div class="row">
                                    <div class="col-md-6 col-6 mt-3">

                                        @php
                                            $error_class_first_name='';
                                        @endphp
                                        @if ($errors->has('first_name'))
                                            @php
                                                $error_class_first_name='error';
                                            @endphp
                                            <span class="error-msg">
                                    <i class="fa fa-caret-right"></i>{{ $errors->first('first_name') }}
                                </span>
                                        @endif

                                        <input class="myinput {{$error_class_first_name}}" type="text" name="first_name"
                                               value="{{old('first_name')}}" placeholder="{{trans('first_name')}}">

                                    </div>
                                    <div class="col-md-6 col-6 mt-3">

                                        @php
                                            $error_class_last_name='';
                                        @endphp
                                        @error('last_name')
                                        @php
                                            $error_class_last_name='error';
                                        @endphp
                                        <span class="error-msg">
                                    <i class="fa fa-caret-right"></i>{{ $errors->first('last_name') }}
                                </span>
                                        @enderror

                                        <input class="myinput {{$error_class_last_name}}" type="text" name="last_name"
                                               value="{{old('last_name')}}" placeholder="{{trans('last_name')}}">
                                    </div>

                                    <div class="col-md-5 col-4">
                                        <div class="dropdown myselect2">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                               data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                <img class="flag" id="country_img"
                                                     src="{{ asset("assets/web/img/Icons/world.png") }}">
                                                <span id="country_code">{{trans('country_key')}}</span>
                                            </a>

                                            <input type="hidden" id="phone_code" name="country_key">

                                            <ul class="dropdown-menu" id="phone_code_ul"
                                                aria-labelledby="dropdownMenuLink">
                                                @foreach($countries as $country)
                                                    <li class="dropdown-item my-item"
                                                        data-value="{{$country->id}}">
                                                        <img class="flag" src="{{ $country->image}}">
                                                        <span>{{$country->code}}</span>
                                                    </li>
                                                @endforeach

                                            </ul>

                                        </div>
                                    </div>

                                    <div class="col-md-7 col-8">

                                        @php
                                            $error_class_phone='success';
                                        @endphp
                                        @if ($errors->has('phone'))
                                            @php
                                                $error_class_phone='error';
                                            @endphp
                                            <span class="error-msg">
                                    <i class="fa fa-caret-right"></i>{{ $errors->first('phone') }}
                                </span>
                                        @endif

                                        <input class="myinput {{$error_class_phone}}" type="text" name="phone"
                                               value="{{old('phone')}}" placeholder="{{trans('enter_your_phone')}}">

                                    </div>

                                    <div class="col-md-12 col-12">

                                        @php
                                            $error_class_email='';
                                        @endphp
                                        @if ($errors->has('email'))
                                            @php
                                                $error_class_email='error';
                                            @endphp
                                            <span class="error-msg" id="emailError">
                                    <i class="fa fa-caret-right"></i>{{ $errors->first('email') }}
                                </span>
                                        @endif

                                        <input class="myinput" type="email" id="email" name="email"
                                               value="{{old('email')}}" placeholder="{{trans('email')}}">

                                        {{--                        <span class="success-msg" id="emailError" style="visibility:hidden ; margin-left:270px; backgroond-color:red;">--}}
                                        {{--                          <i class="fa fa-caret-right"  ></i>--}}
                                        {{--                        </span>--}}

                                    </div>

                                    <input type="hidden" name="type" value="{{ $type }}">

                                    <div class="col-md-12 col-12">

                                        @php
                                            $error_class_password='';
                                        @endphp
                                        @if ($errors->has('password'))
                                            @php
                                                $error_class_password='error';
                                            @endphp
                                            <span class="error-msg">
                                    <i class="fa fa-caret-right"></i>{{ $errors->first('password') }}
                                </span>
                                        @endif
                                        <input class="myinput" type="password" name="password"
                                               placeholder="{{trans('password')}}">

                                    </div>

                                    <div class="col-md-12 col-12">

                                        @php
                                            $error_class_password_confirmation='';
                                        @endphp
                                        @if ($errors->has('password_confirmation'))
                                            @php
                                                $error_class_password_confirmation='error';
                                            @endphp
                                            <span class="error-msg">
                                    <i class="fa fa-caret-right"></i>{{ $errors->first('password_confirmation') }}
                                </span>
                                        @endif

                                        <input class="myinput" type="password" name="password_confirmation"
                                               placeholder="{{trans('password_confirmation')}}">

                                    </div>

                                    <input type="hidden" name="type" value="{{$type}}">

                                    <div class="col-md-8 col-12">
                                        <input type="submit" class="btn sign-btn" value="سجل الان">
                                    </div>

                                    <div class="myspan"></div>

                                    <div class="col-md-7 col-12">
                                        <div class="enter-content">
                                            <h3>{{trans('or_login_by')}}</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <div class="enter-content">

                                            <a href="">
                                                <img src="{{ asset("assets/img/Icons/facebook_color.png")}}" alt="">
                                            </a>
                                            <a href="">
                                                <img src="{{ asset("assets/img/Icons/google_color.png") }}" alt="">
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@stop
@section('scripts')

    <script language="javascript">
        $(document).ready(function () {
            $('#phone_code_ul  li').on('click', function (e) {
                var phone_code_value = $(this).attr("data-value");
                var country_img = $(this).find('img').attr('src');
                $('#phone_code').val(phone_code_value);
                $('#country_code').text(phone_code_value);
                $('#country_img').attr('src', country_img);

            });
        });
    </script>
@endsection
