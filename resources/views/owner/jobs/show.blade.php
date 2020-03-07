@extends('owner.layout')

@section('content')
    <section class="js-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-6">
                    <div class="header-content">
                    <h2> {{$job->title}}</h2>
                        <p> </p>
                    </div>
                </div>
                <div class="col-md-8 col-6">
                    <div class="header-contact">
                    <a href="{{route('owner.users.jobs.edit',['user' =>$user->id , 'job' =>$job->id])}}">
                        <img src="./img/Icons/edit_red.png" alt="">
                    <h3> {{trans('edit_job_description')}}</h3>
                        </a>
                    </div>
                    <div class="header-contact">
                    <a href="{{ route('owner.users.jobs.SeekerSearch', ['user' => $user->id, 'job' => $job->id]) }}">
                        <img src="./img/Icons/search_red.png" alt="">
                    <h3> {{trans('apply_search')}}</h3>
                        </a>
                    </div>
                </div>
          </div>
        </div>
    </section>

    <section class="jop-vacancy">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="Resutl2">
                        <div class="box-result">
                            <div class="head-box">
                                <div class="row">
                                    <div class="col-lg-8 col-md-6">
                                        <h3 class="head-text">مصمم جرافيك</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-block dropdown-toggle" data-toggle="dropdown">
                                                <img src="img/Icons/filter.png" alt="">
                                                ترتيب حسب
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
                        <div class="box-content text-center">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="accept">
                                        <h1>10</h1>
                                        <h2>تم تعينهم</h2>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="wait">
                                        <h1>65</h1>
                                        <h2>قائمة الانتظار</h2>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="rejected">
                                        <h1>25</h1>
                                        <h2>غير مؤهل</h2>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="all">
                                        <h1>100</h1>
                                        <h2>الكل</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="Resutl">

                        <div class="box-result">
                            <div class="head-box">
                                <div class="row">
                                    <a href="bo-dashboard2.html" class="col-lg-8 col-md-6">
                                        <h3>مصمم جرافيك</h3>
                                        <p> 3+ سنوات من الخبرة مستوي الخبرة</p>
                                    </a>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="dropdown drop-accept">
                                            <button type="button" class="btn btn-block dropdown-toggle" data-toggle="dropdown">
                                                <img src="img/Icons/add_person_green.png" alt="">
                                                تعيين
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item" href="#">
                                                <label>
                                                    <input type="radio" name="" value="">
                                                    <span>تعيين</span>
                                                </label>
                                                </li>
                                                <li class="dropdown-item" href="#">
                                                <label>
                                                    <input type="radio" name="" value="">
                                                    <span>قائمة الانتظار</span>
                                                </label>
                                                </li>
                                                <li class="dropdown-item" href="#">
                                                <label>
                                                    <input type="radio" name="" value="">
                                                    <span>غير مؤهل</span>
                                                </label>
                                                </li>
                                                <hr>
                                                <li class="li-form">
                                                <form action="bo-add-jobs.html">
                                                    <button class="btn-add-job  mb-1">
                                                    <img src="img/Icons/error.png" alt="">
                                                    حذف المتقدم
                                                    </button>
                                                </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="bo-dashboard2.html" class="box-content">
                            <div class="row">
                                <div class="col-md-4">
                                <div class="box-info">
                                    <h3>الجنسية</h3>
                                    <p>السعودية</p>
                                    <h3>المؤهل الدراسي</h3>
                                    <p>بكالوريوس فنون تطبيقية</p>
                                </div>
                                </div>
                                <div class="col-md-8">
                                <div class="box-info">
                                    <h3>التخصص المهنى</h3>
                                    <span>التسويق / العلاقات العامة / الإعلان</span>
                                    <span>الرياضة والترفية</span>
                                    <span>+3</span>
                                </div>
                                <div class="box-info">
                                    <h3>التخصص المهنى</h3>
                                    <span>التسويق / العلاقات العامة / الإعلان</span>
                                    <span>الرياضة والترفية</span>
                                    <span>+3</span>
                                </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="statics mt-0">
                        <div class="static-header">
                            <h2>بيانات الوظيفة</h2>
                        </div>
                        <div class="static-box static-box-bo">
                            <h3>المهارات الوظيفية</h3>
                            <p>كلمات دلالية, دلالات توضيحية, مجالات العمل الواضح, مجالات العمل الواضح</p>
                            <h3>سنوات الخبرة</h3>
                            <p>2سنة 8 شهر</p>
                            <h3>مستوى الخبرة</h3>
                            <p>فوق المتوسط</p>
                            <h3>موقع الوظيفة</h3>
                            <p>المملكة العربية السعودية</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


