@extends('owner.layout')

@section('content')

    <?php
    use \App\Constants\YearsExperiences;
    use \App\Constants\EducationLevel;
    use \App\Constants\CareerLevels;
    use \App\Constants\CompanySize ;
    ?>
    <!-- start header -->
    <section class="js-header">
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-6">
                    <div class="header-content">
                        <h2>{{ auth()->user()->name}}</h2>
                        <p>  {{ auth()->user()->job_title}}</p>
                    </div>
                </div>
                <div class="col-md-8 col-6">
                    <div class="header-contact" data-toggle="modal" data-target="#exampleModalCenter4">
                        <a href="{{ route('owner.users.jobs.create',['user'=>auth()->user()]) }}">
                            <img src="{{url('')}}/assets/web/img/Icons/add_job.png" alt="">
                            <h3>{{trans('add_job')}} </h3>
                        </a>
                    </div>
                    <div class="header-contact">
                        <a href="Bo-stepper1.html">
                            <img src="{{url('')}}/assets/web/img/Icons/edit_red.png" alt="">
                        <h3> {{ trans('company_data') }}</h3>
                        </a>
                    </div>
                </div>
            <!-- <div class="col-md-3 col-3">
                  <div class="header-contact" data-toggle="modal" data-target="#exampleModalCenter4">
                    <a href="">
                      <img src="{{url('')}}/assets/web/img/Icons/add_red.png" alt="">
                    </a>

                    <h3>بيانات التواصل</h3>
                  </div>
                </div> -->
            </div>

        </div>
    </section>

    <!-- end header -->
    <!-- start personal section -->
    <section class="js-profile">
        <div class="container">

            <div class="row">
                <div class="col-md-9">
                    <div class="mymenu">
                        <div class="row">

                            <div class="col-md-4 col-4">
                                <div class="header-profile">
                                    <a class="active" href="">{{trans('jobs')}}</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-4">
                                <div class="header-profile">
                                    <a href="#/bo-masseage.html">{{trans('messages')}}</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-4">
                                <div class="header-profile">
                                    <a href="#/jsnotification.html">{{trans('notifications')}}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--  -->
                    <section class="jobs">

                        @foreach ($list as $job)
                            <div class="box-jobs">
                            <a class="mylink" href="{{ route('owner.users.jobs.show',['user' => $user->id, 'job' => $job->id]) }}"></a>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="box-job-name">
                                            <h3>{{ $job->title }}</h3>
                                            <p>{{trans('field_of_work')}} : {{$job->industry->name}}</p>
                                            <p>{{trans('experience')}}
                                                : {{YearsExperiences::getOne($job->years_of_experience)}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box-edit">

                                            <a href="{{route('owner.users.jobs.edit',['user'=>auth()->user(),'job'=>$job->id])}}"
                                               class="edit">
                                                <img src="{{url('')}}/assets/web/img/Icons/edit_blue.png" alt="">
                                            </a>
                                            <a href="#Modal_{{ $job->id }}" onclick="return deleteModal('Modal_{{ $job->id }}');"
                                               class="delete" data-toggle="modal"
                                               data-target="#exampleModalCenter2">
                                                <img src="{{url('')}}/assets/web/img/Icons/delete.png" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box-info">
                                            <div class="row">
                                                <div class="col-4 all">
                                                    <h3>2154</h3>
                                                    <p>{{trans('all')}}</p>
                                                </div>
                                                <div class="col-4 wait">
                                                    <h3>132</h3>
                                                    <p>{{trans('waiting')}}</p>
                                                </div>
                                                <div class="col-4 accept">
                                                    <h3>34</h3>
                                                    <p>{{trans('acceptable')}}</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </section>
                    <!--  -->

                </div>
                <div class="col-md-3">
                    <div class="statics">
                        <div class="static-header">
                            <h2>{{trans('company_data')}} </h2>
                        </div>
                        <div class="static-box static-box-bo">
                            <h3> {{trans('company_name')}}</h3>
                            <p>{{$companyDetails->company_name}}</p>
                            <h3> {{trans('company_location')}}</h3>
                            <p>{{$companyDetails->location->name}}</p>
                            <h3> {{trans('company_size')}}</h3>
                            <p>{{CompanySize::getOne($companyDetails->company_size)}}</p>
                            <h3> {{trans('company_industry')}}</h3>
                            <p> {{$companyDetails->industry->name}}</p>
                        </div>


                    </div>
                   
                </div>
            </div>
        </div>
    </section>


    <!-- end personal section -->
    @foreach ($list as $job)
        <div class="modal model2  model-delete fade" id="Modal_{{ $job->id }}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-md-12 mx-auto">
                            <form class="row" action="{{ route('owner.users.jobs.destroy', ['user'=>auth()->user(),'job' => $job]) }}" method="Post">
                                @method('DELETE')
                                @csrf
                                <div class="head-title col-12">
                                    <h2>{{trans('delete_the_job')}}</h2>
                                    <p>{{trans('really_delete_the_job')}}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-close" data-dismiss="modal">{{trans('back')}}</button>
                                    <button type="submit" class="btn btn-delete">{{trans('delete_the_job')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@stop


