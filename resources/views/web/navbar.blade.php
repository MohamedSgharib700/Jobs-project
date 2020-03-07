<!-- Start Navbar -->
<?php
use App\Constants\UserTypes;

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{url('')}}">
            <img src="{{url('')}}/assets/web/img/Icons/logo_ar.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ul-first">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('')}}">{{trans('home')}}<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">

                    <a class="nav-link" href="{{route('web.seekers.index')}}">{{trans('cvs')}}</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{trans('agencies')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{trans('blog')}}</a>
                </li>

            </ul>


            <ul class="navbar-nav ul-second">
                @if(!auth()->check())
                    <li class="nav-item myitem">
                        <a href="{{ route('web.auth.login') }}" class="btn" name="button">{{trans('login')}}</a>
                    </li>

                    <li class="nav-item myitem2">
                        <a href="{{ route('web.type') }}" class="btn" name="button">{{trans('new_account')}}</a>
                    </li>

                    <!-- after login -->
                @else
                    <li class="nav-item ">
                        <div class="btn-group user-drop">
                            <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                {{auth()->user()->name}}
                            </button>
                            <div class="dropdown-menu">

                                    @if(auth()->user()->employerDetails == null)
                                        <a class="dropdown-item" href="{{route('owner.companies.create',['employer'=>auth()->user()->id])}}">{{trans('personal_info')}}</a>
                                    @else
                                      <a class="dropdown-item"
                                       href="{{route('owner.users.companies.edit',
                                       ['user' => auth()->user()->id , 'employerDetails' => auth()->user()->employerDetails->id])}}">
                                        {{trans('personal_info')}}
                                    </a>
                                    @endif
                                      <a class="dropdown-item" href="./jsnotification.html">{{trans('notifications')}}</a>
                                      <a class="dropdown-item" href="./jsmasseage.html">{{trans('messages')}}</a>
                                     <a class="dropdown-item" href="{{route('web.seekers.edit',['seeker'=> auth()->user()->id])}}">{{trans('settings')}}</a>
                                      <a class="dropdown-item" href="{{ route('web.auth.logout') }}">{{ trans('logout') }}</a>
                    
                            </div>
                        </div>
                    </li>

                    <li class="nav-item myitem2">

                        <!-- after login -->
                        <a class="btn" name="button" href="jsprofile.html">{{ trans('control_board') }}</a>
                    </li>
                @endif

                <li class="nav-item dropdown my-dropdown">

                    <a class="nav-link lang-dropdown" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        {{app()->getLocale() }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        @foreach (Config::get('app.locales') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <a href="{{ route(Route::currentRouteName(), array_merge( request()->route()->parameters(), ['lang' => $lang])) }}"
                                   class="dropdown-item">
                                    {{$language}}
                                </a>
                            @endif
                        @endforeach

                    </div>
                </li>
            </ul>

        </div>

    </div>
</nav>
<!-- end Navbar -->

