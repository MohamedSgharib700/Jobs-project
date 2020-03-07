@extends('admin.auth.base')

@section('auth.content')




    <!--single-page open-->
    <div class="single-page">
        <div class="">
            <div class="wrapper wrapper2">
                <img src="{{url('')}}/assets/img/CV Logo.png" class="img-fluid mt-3" alt="">
                @if(session()->has('error'))
                    <div class="col-12">
                        <div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                            <div class="alert-icon"><i class="ion ion-ios-lightbulb-outline"></i></div>
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                <div class="alert-title">{{trans('error')}}</div>
                                {{ session('error') }}
                            </div>
                        </div>
                    </div>
                @elseif(session()->has('success'))
                    <div class="col-12">
                        <div class="alert alert-success alert-has-icon alert-dismissible show fade">
                            <div class="alert-icon"><i class="ion ion-ios-lightbulb-outline"></i></div>
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                <div class="alert-title">{{trans('success')}}</div>
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif
                <form action="{{ route('admin.auth.attempt') }}"  method="post" class="card-body"  tabindex="500">
                    {{ csrf_field() }}
                    <h3 class="text-dark">{{trans('login')}}</h3>
                    <div class="mail">
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="{{trans('email')}}">
                    </div>
                    <div class="passwd">
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="{{trans('password')}}">
                    </div>

                    <div class="submit">
                        <button  type="submit" class="btn btn-primary btn-block">{{trans('login')}}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!--single-page closed-->

@stop
