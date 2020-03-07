@extends('web.layout')
@section('content')

<?php
use \App\Constants\YearsExperiences;
use \App\Constants\EducationLevel;
use \App\Constants\UserTypes;
?>
    <section class="search">
        <div class="container">
            <div class="row">
                @include('web.result')
                <div class="col-lg-9 col-md-8">
                    @foreach($list as $seeker)
                        <div class="Resutl">
                            <div class="box-result">
                                <div class="head-box">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-6">
                                            <h3>{{$seeker->job_title}}</h3>
                                            <p> {{ $seeker->experiences ? YearsExperiences::getOne($seeker->experiences->years_of_experience) : '--'}} </p>
                                        </div>
                                        @if(auth()->check() && auth()->user()->type == UserTypes::OWNER)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="dropdown drob-result">
                                                    <button type="button" class="btn btn-block dropdown-toggle" data-toggle="dropdown">
                                                        <img src="{{url('')}}/assets/img/Icons/add_red.png" alt="">
                                                        {{trans('add_to')}}
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @foreach(auth()->user()->jobs as $job)
                                                            <li class="dropdown-item"  >
                                                                <label>
                                                                    <a class="job" value="{{$job->id}}"> {{$job->title}} </a>
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                        <hr>
                                                        <li class="li-form">
                                                            <button class="btn-add-job mb-1">
                                                                <img src="{{url('')}}/assets/img/Icons/add_red.png" alt="#">
                                                                <a href="{{route('owner.users.jobs.create',['user' => auth()->user()->id])}}">
                                                                    {{trans('add_job')}}
                                                                </a> 
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(auth()->check())
                                @if(auth()->user()->type == UserTypes::OWNER)
                                    <a href="{{route('web.seeker.profile',['seeker' => $seeker->id])}}" class="box-content">
                                @endif
                            @else 
                                <a class="box-content" data-toggle="modal" data-target="#exampleModal">
                            @endif
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="box-info">
                                            <h3>{{trans('nationality')}}</h3>
                                            <p>{{ $seeker->country ? $seeker->country->name : '--'}}</p>
                                            <h3>{{trans('educations_level')}}</h3>
                                            <p>
                                                {{ $seeker->experiences ? EducationLevel::getOne( $seeker->experiences->education_level ) : '--'}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="box-info">
                                            <h3>{{trans('industry')}}</h3> 
                                            @foreach($seeker->industries as $industry)
                                                <span>{{ $industry ? $industry->name : '--'}}</span>
                                            @endforeach
                                            <span>+3</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center">
                        {{ $list->links() }}
                    </div>
                </div>
                <!-- End Section Result  -->
            </div>
        </div>
 
        <div class="modal fade modal-login" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <span>
                        <img src="{{url('')}}/assets/img/Icons/resigter.png" alt="">
                        </span>
                        <h1>{{trans('forget')}}</h1>
                        <p>{{trans('check_your_account')}}</p>
                    </div>
                    <div class="modal-footer mx-auto mb-5">
                        <a href="{{route('web.auth.register')}}" class="btn btn-signup">{{trans('new_account')}}</a>
                        <a href="{{route('web.auth.login')}}" class="btn btn-login">{{trans('i_have_account')}}</a>
                    </div>
                </div>
            </div>
        </div>
       
    </section>
  
@stop
