@extends('web.layout')

@section('content')
<section class="sign">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mx-auto">
        <form class="sign-form" action="{{route('web.auth.attempt')}}" method="post">
          @csrf
            <div class="col-12">
                <h2> {{ trans('login')}}</h2>
                <p>{{ trans('enter_password_and_email') }}</p>
            </div>
            <div class="row">

                <div class="col-md-12 col-12">
                    <input class="myinput" type="email" name="email" value="" placeholder="{{trans('email')}}">
                    @if ($errors->has('email'))
                    <span class="error-msg" role="alert" style="margin-left: 45px;">
                      <i class="fa fa-caret-right"></i>
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                </div>
               
                <div class="col-md-12 col-12">
                    <input class="myinput" type="password" name="password" value="" placeholder="{{trans('password')}}">
                    @if ($errors->has('password'))
                        <span class="error-msg" role="alert" style="margin-left: 80px;">
                          <i class="fa fa-caret-right"></i>

                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-6 col-6">
                  <button class="btn sign-btn" href="#">دخول</button>
                </div>
                <div class="col-md-6 col-6">
                  <a class="reset" href="./forgetpass.html">نسيت كلمة المرور</a>
                </div>
            </div>

            <div class="myspan"></div>

            <div class="enter-content">
            <h3>{{trans("or_login_by")}}</h3>
              <a href="">
                <img src="{{asset('assets/img/Icons/facebook_color.png')}}" alt="">
              </a>
              <a href="">
                <img src="{{asset('assets/img/Icons/google_color.png')}}" alt="">
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>   
@stop
