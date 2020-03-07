@extends('owner.layout')
<?php 
use App\Constants\CareerLevels;
?>
@section('content')
<section class="search">
    <div class="container">
        <div class="row">
            @include('owner.jobs.conclusions')
            <div class="col-md-9">
                @foreach($users as $user)
                <div class="Resutl">
                        <div class="box-result">
                          <div class="head-box">
                            <div class="row">
                              <div class="col-lg-8 col-md-6">
                              <h3> {{$job->title}} </h3>
                              <p> {{ trans('year_of_experience') }}: ( {{$job->years_of_experience}} ) </p>
                              </div>
                              <div class="col-lg-4 col-md-6">
                                <div class="dropdown drob-result">
                                  <button type="button" class="btn btn-block dropdown-toggle" data-toggle="dropdown">
                                    <img src="img/Icons/add_red.png" alt="">
                                    أضف إلى
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li class="dropdown-item" href="#">
                                      <label>
                                        <input type="radio" name="" value="">
                                        <span>مصمم جرافيك</span>
                                      </label>
                                    </li>
                                    <li class="dropdown-item" href="#">
                                      <label>
                                        <input type="radio" name="" value="">
                                        <span>محاسب</span>
                                      </label>
                                    </li>
                                    <li class="dropdown-item" href="#">
                                      <label>
                                        <input type="radio" name="" value="">
                                        <span>مطور برمجيات</span>
                                      </label>
                                    </li>
                                    <hr>
                                    <li class="li-form">
                                      <form action="bo-add-jobs.html">
                                        <button class="btn-add-job mb-1">
                                          <img src="img/Icons/add_red.png" alt="">
                                          أضف وظيفة
                                        </button>
                                      </form>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <a href="bo-dashboard.html" class="box-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="box-info">
                                        <h3>{{trans('nationality')}}</h3>
                                        <p>{{$user->country->name }}</p>
                                        <h3> {{ trans('educational_qualification')}}</h3>
                                        <p> {{  CareerLevels::getOne($user->experiences->career_level) }}</p>
                                    </div>
                              </div>
                              <div class="col-md-8">
                                    <div class="box-info">
                                        <h3> {{ trans('professional_specialization')}}</h3>
                                        @foreach($user->roles as $role)
                                            <span class="text-center">{{$role->name}}</span>
                                        @endforeach
                                    </div>
                                    <div class="box-info">
                                        <h3> {{ trans('professional_field')}}</h3>
                                        @foreach($user->industries as $industry)
                                            <span class="text-center">{{$industry->name}}</span>
                                        @endforeach
                                    </div>
                              </div>
                            </div>
                        </a>
                      </div> 
                @endforeach        
            </div>
        </div>
    </div>
</section>
@stop


