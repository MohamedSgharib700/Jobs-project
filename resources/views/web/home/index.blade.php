@extends('web.layout')

@section('content')

    <!-- start header -->
    <section class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <form class="header-content">

                        <h2>{{trans('your_dream_job_is_now_closer')}}</h2>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="dropdown myselect2">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                       data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <img class="flag" src="{{url('')}}/assets/web/img/Icons/saudi_arabia.png" alt="">
                                        السعودية
                                    </a>
                                    <input class="input-hidden" type="text" name="" value="">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li class="dropdown-item my-item">
                                            <img class="flag" src="{{url('')}}/assets/web/img/Icons/egypt.png" alt="">
                                            <span>مصر</span>
                                        </li>
                                        <li class="dropdown-item my-item">
                                            <img class="flag" src="{{url('')}}/assets/web/img/Icons/india.png" alt="">
                                            <span>الهند</span>
                                        </li>
                                        <li class="dropdown-item my-item">
                                            <img class="flag" src="{{url('')}}/assets/web/img/Icons/united_arab_emirates.png" alt="">
                                            <span>الامارات</span>
                                        </li>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <input class="myinput" type="text" name="email" value="" placeholder="ابحث عن متقدمين ">
                            </div>

                            <div class="col-md-3">
                                <button type="button" class="btn mysearch">{{trans('search')}}<i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <p>{{trans('join_now_more_professional_CVs')}}</p>
                            </div>
                            <div class="col-md-4">
                                <a class="join" href="{{ route('web.type') }}">{{trans('register_now')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- end header -->
    <!-- start contact -->
    <section class="contact">
        <div class="container">
            <div class="col-12">
                <h2> {{trans('contact_the_best_candidates')}}</h2>
                <p>{{trans('learn_the_latest_lists_of_applicants_in_all_fields')}} , <a href="#">{{trans('start_now')}}</a></p>
            </div>
            <div class="con-content">
                <div class="row">
                    @if(!empty($jobs))   
                    @foreach($jobs as $job)
                    <div class="col-md-3">
                        <div class="sub-content">
                            <h3>{{@$job->industry->name}}</h3>
                            <span>{{@$job->location->name}}</span>
                        </div>
                    </div>
                    @endforeach
                    @endif


                </div>
            </div>
        </div>
    </section>
    <!-- end contact -->
    <!-- why cv start -->
    <section class="why">
        <div class="container">
            <div class="col-12">
                <h2>{{trans('why_cv_world')}}</h2>
                <p>{{trans('one_place_where_a_job_seeker_and_employer_meet' )}}, <a href="{{ route('web.type') }}">{{trans('register_now')}}</a></p>
            </div>
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="content">
                            <div class="sub-content" id="tab1-content">
                                <div class="content-header">
                                    <h3>{{trans('a_more_professional_form_of_job_seeker_skills')}}</h3>
                                </div>
                                <ul class="list-unstyled">
                                    <li>{{trans('choose_the_workplace_as_desired')}}</li>
                                    <li>{{trans('fill_out_a_ready_made_CV_from_the_site')}}</li>
                                    <li>{{trans('see_your_profile_traffic')}}</li>
                                </ul>
                            </div>
                            <div class="sub-content" id="tab2-content">
                                <div class="content-header">
                                    <h3>{{trans('the_most_reliable_source_for_hiring_new_cadres')}}</h3>
                                </div>
                                <ul class="list-unstyled">
                                    <li>{{trans('find_new_applicants_with_ease')}}</li>
                                    <li>{{trans('communicate_directly_with_the_best')}}</li>
                                    <li>{{trans('advertise_vacancies_for_users')}}</li>
                                </ul>
                            </div>
                            <div class="sub-content" id="tab3-content">
                                <div class="content-header">
                                    <h3>{{trans('a_platform_rich_in_everything_a_resh_graduate_needs_to_start_his_career')}}</h3>
                                </div>
                                <ul class="list-unstyled">
                                    <li>{{trans('learn_more_about_the_developments_in_your_field')}}</li>
                                    <li>{{trans('learn_job_training_and_tips')}}</li>
                                    <li>{{trans('practice_new_communication_skills_and_learning_methods')}}</li>

                                </ul>
                            </div>
                            <div class="tabs">
                                <ul class="list-unstyled">
                                    <li class="active" id="tab1"></li>
                                    <li id="tab2"></li>
                                    <li id="tab3"></li>
                                    <!-- <li id="tab4"></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="img" id="tab1-contente">
                            <img src="{{url('')}}/assets/web/img/feature_1.jpg" alt="">
                        </div>
                        <div class="img" id="tab2-contente">
                            <img src="{{url('')}}/assets/web/img/feature_2.jpg" alt="">
                        </div>
                        <div class="img" id="tab3-contente">
                            <img src="{{url('')}}/assets/web/img/feature_3.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- why cv end -->
    <!-- works start -->
    <section class="works">
        <div class="container">
            <div class="col-12">
                <h2>{{trans('vacancies_are_waiting_for_you')}}</h2>
                <p>{{trans('be_ready_for_a_better_future')}}، <a href="#">{{trans('start_now')}}</a></p>
            </div>
            <div class="con-content">
                <div class="row">

                @foreach($industries as $industry)
                    <div class="col-md-3">
                        <div class="sub-content">
                            <h3>{{@$industry->jobs_count}} {{trans('job')}}</h3>
                            <span>{{@$industry->name}}</span>
                        </div>
                    </div>
                @endforeach



                </div>
            </div>
        </div>
    </section>
    <!-- works end  -->
    <!-- story start -->
    <section class="story">
        <div class="container">
            <div class="col-12">
                <h2>{{trans('cv_world_blog')}}</h2>
                <p>{{trans('learn_more_prepare_for_a_better_career')}}، <a href="#">{{trans('read_more')}}</a></p>
            </div>
            <div class="row">
            @if(!empty($list))
                @foreach($list as $post)
                <div class="col-md-4">
                    <div class="story-content">
                        <img class="img-fluid" src="{{url('')}}{{$post->image}}" alt="">
                        <h3>{{$post->name}}</h3>
                        <p>{{str_limit($post->description, 100)}}</p>
                        <h4>{{$post->created_at}}</h4>
                    </div>
                </div>
                @endforeach
            @endif    

            </div>
        </div>
    </section>
    <!-- story end  -->

@stop
