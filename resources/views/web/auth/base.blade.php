@extends('web.layout')

@section('content')
    <section class="userditels">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="profil-info">
                        <br>
                        <ul class="box-other list-unstyled m-0 p-0">
                            <li class="prsi  {{ request()->route()->getName() == 'web.auth.login' ? 'prsi-active' : '' }}">
                                <a href="{{ route('web.auth.login') }}">
                                    <i class="fa fa-sign-in-alt"></i>
                                    تسجيل دخول
                                </a>
                            </li>
                            <li class="prsi {{ request()->route()->getName() == 'web.auth.register' ? 'prsi-active' : '' }}">
                                <a href="{{ route('web.auth.register') }}">
                                    <i class="fa fa-users"></i>
                                    حساب جديد
                                </a>
                            </li>
                            <li class="prsi  {{ request()->route()->getName() == 'password.reset' ? 'prsi-active' : '' }}">
                                <a href="{{ route('password.reset') }}">
                                    <i class="fa fa-lock"></i>
                                    نسيت كلمة المرور؟
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @yield('auth.content')
            </div>
        </div>
    </section>
@stop