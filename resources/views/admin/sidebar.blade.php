<!--aside open-->
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div class="dropdown user-pro-body text-center">
            <div class="nav-link pl-1 pr-1 leading-none ">
                <img src="{{url('')}}/assets/img/avatar/avatar-3.jpeg" alt="user-img"
                     class="avatar-xl rounded-circle mb-1">
                <!-- <span class="pulse bg-success" aria-hidden="true"></span> -->
            </div>
            <div class="user-info">
                <h6 class=" mb-1 text-dark">{{ auth()->user()->name}}</h6>
            </div>
        </div>
    </div>

    <ul class="side-menu">
        <li class="slide">
            <a class="side-menu__item" href="{{ route('admin.home.index') }}" data-toggle="slide" href="#"><i
                    class="side-menu__icon fa fa-home"></i>
                <span class="side-menu__label">{{trans('home')}}</span>
            </a>
        </li>
    </ul>
    @can("seekersIndex", User::class)
    <ul class="side-menu">
        <li class="slide">
            <a href="{{ route('admin.seekers.index') }}" class="side-menu__item" data-toggle="slide" href="#">
                <i class="side-menu__icon fa fa-search"></i>
                <span class="side-menu__label">{{ trans('seekers') }}</span>
            </a>
        </li>
    </ul>
    @endcan
    @can("employersIndex", User::class)
    <ul class="side-menu">
        <li class="slide">
            <a href="{{ route('admin.employers.index') }}" class="side-menu__item" data-toggle="slide" href="#">
                <i class="side-menu__icon fa fa-male"></i>
                <span class="side-menu__label">{{trans('employers')}}</span>
            </a>
        </li>
    </ul>
    @endcan
    @can('index', Location::class)
        <ul class="side-menu">
            <li class="slide">
                <a href="{{route('admin.locations.index')}}" class="side-menu__item" data-toggle="slide">
                    <i class="side-menu__icon fa fa-map-pin"></i>
                    <span class="side-menu__label">{{trans('locations')}}</span>
                </a>
            </li>
        </ul>
    @endcan
    @can('index', Industry::class)
        <ul class="side-menu">
            <li class="slide">
                <a href="{{ route('admin.industries.index') }}" class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-industry"></i>
                    <span class="side-menu__label ">{{trans('industries')}}</span>
                </a>
            </li>
        </ul>
    @endcan

        <ul class="side-menu">
            <li class="slide">
                <a href="{{ route('admin.jobs.index') }}" class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-circle"></i>
                    <span class="side-menu__label ">{{trans('jobs')}}</span>
                </a>
            </li>
        </ul>
 
    @can("index", Log::class)
        <ul class="side-menu">
            <li class="slide">
                <a href="{{ route('admin.logs.index') }}" class="side-menu__item" data-toggle="slide">
                    <i class="side-menu__icon fa fa-history"></i>
                    <span class="side-menu__label ">{{trans('logs')}}</span>
                </a>
            </li>
        </ul>
    @endcan

    @can("index", Agency::class)
        <ul class="side-menu">
            <li class="slide">
                <a href="{{ route('admin.agencies.index') }}" class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-building"></i>
                    <span class="side-menu__label ">{{trans('agencies')}}</span>
                </a>
            </li>
        </ul>
    @endcan
    @can("index", User::class)
        <ul class="side-menu">
            <li class="slide">
                <a href="{{ route('admin.users.index') }}" class="side-menu__item" data-toggle="slide" href="#">
                        <i class="side-menu__icon fa fa-user"></i>
                    <span class="side-menu__label">{{trans('users')}}</span>
                </a>
            </li>
        </ul>
    @endcan
    @can("index", Group::class)
        <ul class="side-menu">
            <li class="slide">
                <a href="{{ route('admin.groups.index') }}" class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-group"></i>
                    <span class="side-menu__label ">{{trans('groups')}}</span>
                </a>
            </li>
        </ul>
    @endcan
    @can("index" , Permission::class)
        <ul class="side-menu">
            <li class="slide">
                <a href="{{ route('admin.permissions.index') }}" class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-shield"></i>
                    <span class="side-menu__label ">{{trans('permissions')}}</span>
                </a>
            </li>
        </ul>
    @endcan 
    @can("index" , Blog::class)
        <ul class="side-menu">
            <li class="slide">
                <a href="{{ route('admin.blog.index') }}" class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-cube"></i>
                    <span class="side-menu__label ">{{trans('blog')}}</span>
                </a>
            </li>
        </ul>
    @endcan
        <ul class="side-menu">
            <li class="slide">
                <a href="{{ route('admin.auth.logout') }}" class="side-menu__item" data-toggle="slide" href="#">
                    <i class="side-menu__icon fa fa-sign-out"></i>
                    <span class="side-menu__label ">{{trans('log_out')}}</span>
                </a>
            </li>
        </ul>
</aside>

<!--aside closed-->
