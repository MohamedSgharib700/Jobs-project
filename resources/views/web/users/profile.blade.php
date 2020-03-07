@extends('web.layout')

@section('content')
    <?php
    use \App\Constants\AgeRange;
    use \App\Constants\YearsExperiences;
    use \App\Constants\EducationLevel;
    use \App\Constants\CareerLevels;
    use \App\Constants\MaritalStatus;
    use \App\Constants\MilitaryStatus;
    use \App\Constants\GenderTypes;

    ?>
    <!-- start header -->
    <section class="js-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-6">
                    <div class="header-content">
                        <h2>{{$user->full_name }}</h2>
                        <p>{{$user->job_title}}</p>
                    </div>
                </div>
                <div class="col-md-8 col-6">
                    <div class="header-contact" data-toggle="modal" data-target="#exampleModalCenter4">

                        <img src="{{url('')}}/assets/web/img/Icons/phone.png" alt="">
                        <h3>{{trans('contact_information')}}</h3>

                    </div>
                    <div class="header-contact">
                        <a href="{{route('profile.edit')}}">
                            <img src="{{url('')}}/assets/web/img/Icons/edit_red.png" alt="">
                            <h3>{{trans('edit_profile')}}</h3>
                        </a>
                    </div>
                </div>
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
                                    <a class="active" href="">{{trans('personal_data')}}</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-4">
                                <div class="header-profile">
                                    <a href="./jsmasseage.html">{{trans('messages')}}</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-4">
                                <div class="header-profile">
                                    <a href="./jsnotification.html">{{trans('notifications')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-data">
                        <div class="profile-content">
                            <div class="label-data">
                                <h3>{{trans('general_data')}}</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-4">
                                    <div class="pr-js mt-0">
                                        <h5>{{trans('nationality')}}</h5>
                                        <h3>{{$user->nationality->name}}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="pr-js  mt-0 ">
                                        <h5>{{trans('residence')}}</h5>
                                        <h3>{{$user->residence->name}}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="pr-js  mt-0">
                                        <h5>{{trans('age')}}</h5>
                                        <h3>{{ AgeRange::getOne($user->age) }}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="pr-js">
                                        <h5>{{trans('marital_status')}}</h5>
                                        <h3>{{MaritalStatus::getOne($user->details->marital_status)}}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="pr-js">
                                        <h5>{{trans('military_status')}}</h5>
                                        <h3>{{MilitaryStatus::getOne($user->details->military_status)}}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 col-4">
                                    <div class="pr-js">
                                        <h5>{{trans('gender')}}</h5>
                                        <h3>{{GenderTypes::getOne($user->gender)}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- start cv -->
                    <div class="cv-content">
                        <h2> {{trans('electronic_cv')}}</h2>
                        <a href="{{$user->details->social_account}}"
                           target="_blank">{{$user->details->social_account}}</a>
                    </div>
                    <div class="cv-content">
                        <h2>{{trans('cv')}}</h2>
                        <a href="{{$user->details->cv}}" target="_blank">{{trans('view_cv')}}</a>
                    </div>
                    <!-- end cv -->

                    <!-- data jobs -->
                    <div class="profile-data">
                        <div class="profile-content">
                            <div class="label-data">
                                <h3>{{trans('career_data')}}</h3>
                            </div>
                            <div class="">
                                <h2>{{trans('career_areas')}}</h2>
                            </div>
                            <div class="">
                                <div class="box-card">
                                    @foreach( $user->industries as $industry)
                                        <div class="skils-card2">
                                            <span>{{$industry->name}}</span>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="">
                                <h2>{{trans('career_specialties')}}</h2>
                            </div>
                            <div class="">
                                <div class="box-card">
                                    @foreach( $user->roles as $role)
                                        <div class="skils-card2">
                                            <span>{{$role->name}}</span>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="">
                                <h2>{{trans('job_skills')}}</h2>
                            </div>
                            <div class="">
                                <div class="box-card">
                                    @foreach( $user->skills as $skill)
                                        <div class="skils-card2">
                                            <span>{{$skill->title}}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- experince -->
                    <div class="experince-data">
                        <div class="exp-content">
                            <div class="label-data">
                                <h2>{{trans('skills')}}</h2>
                            </div>
                            <div class="exp-sub">
                                <h5>{{ trans('education_level') }}</h5>
                                {{--                                <p>{{EducationLevel::getOne($user->experiences->education_level)}} </p>--}}
                                <p>{{$user->experiences->educational_degree}} </p>
                                <h3>{{trans('year')}} : {{$user->experiences->educational_degree_year}}</h3>
                            </div>
                            <div class="exp-sub">
                                <h5>{{trans('previous_experience')}}</h5>
                                <p>{{$user->experiences->previous_experience}}</p>
                                <h5>الوصف الوظيفي</h5>
                                <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز
                                    على الشكل
                                    الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها</p>
                                <h3>تاريخ البدء : أكتوبر 2010</h3>
                            </div>
                            <div class="exp-sub">
                                <h5>{{trans('languages')}}</h5>
                                @foreach( $user->languages as $language)
                                    <p>{{$language->name}}</p>
                                @endforeach
                            </div>
                            <div class="exp-sub">
                                <h5>{{trans('years_of_experience')}}</h5>
                                <p>{{YearsExperiences::getOne($user->experiences->years_of_experience)}}</p>
                            </div>
                            <div class="exp-sub">
                                <h5>{{trans('experience_level')}}</h5>
                                <p> {{CareerLevels::getOne($user->experiences->career_level)}} </p>
                            </div>
                        </div>
                    </div>


                    <!-- country jobs -->
                    <div class="country">
                        <div class="country-content">
                            <div class="country-title">
                                <h2>{{ trans('preferred_country_of_work') }}</h2>
                            </div>
                            <div class="row">
                                @foreach( $user->workingCountries as $workingCountry)
                                    <div class="col-md-4">
                                        <div class="country-sub">
                                            <h2>الرغبة الأولى</h2>
                                            <p>{{$workingCountry->name}}</p>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="statics">
                        <div class="static-header">
                            <h2>{{trans('statistics')}}</h2>
                        </div>
                        <div class="static-box">
                            <h3>{{trans('seeker')}}</h3>
                            <p>{{$seekersCount}}</p>
                            <h3>{{trans('owner')}}</h3>
                            <p>{{$OwnersCount}}</p>
                            <h3>ما تم انجازه</h3>
                            <p>3214</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end personal section -->

    <!-- popup  -->
    <div class="modal fade model-delete" id="exampleModalCenter4" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-12 mx-auto">
                        <form action="">
                            <div class="head-title">
                                <h2>{{trans('contact_information')}}</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="sub-popup">
                                        <h3>{{trans('phone')}}</h3>
                                        <p>
                                            <span>
                                                <img src="{{url('')}}/assets/web/img/Icons/saudi_arabia.png">
                                                {{$user->residence->code}}</span> {{$user->phone}}
                                            <img src="{{url('')}}/assets/web/img/Icons/verified.png"></p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="sub-popup">
                                        <h3>{{trans('email')}}</h3>
                                        <p>{{$user->email}}</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
