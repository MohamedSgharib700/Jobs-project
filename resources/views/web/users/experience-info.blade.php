@extends('web.layout')

@section('content')
    <?php
    use \App\Constants\MilitaryStatus;
    ?>

    <!-- start header -->
    <section class="stepper d-none d-xl-block d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-3">
                    <div class="stepper-number">
                        <span>1</span>
                    </div>
                    <div class="stepper-span2 d-none d-sm-block"></div>
                </div>
                <div class="col-md-2 col-3">
                    <div class="stepper-number">
                        <span>2</span>
                    </div>
                    <div class="stepper-span2 d-none d-sm-block"></div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="stepper-number">
                        <span>3</span>
                        <h2>الخبرة الوظيفية</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end header -->
    <!-- start header -->
    <section class="stepper-phone  d-block d-sm-none d-md-block d-lg-none ">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-4">
                    <div class="stepper-number">
                        <span>1</span>
                    </div>
                    <div class="stepper-span2"></div>
                </div>
                <div class="col-md-3 col-4">
                    <div class="stepper-number">
                        <span>2</span>
                    </div>
                    <div class="stepper-span2"></div>
                </div>
                <div class="col-md-3 col-4">
                    <div class="stepper-number">
                        <span>3</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end header -->

    <!-- start personal section -->
    <section class="personal">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <div class="personal-header">
                            <h2>الخبرة الوظيفية</h2>
                            <p>أدخل تفاصيل الخبرة الوظيفية لديك</p>
                        </div>
                    </div>
                    <form action="">
                        <div class="">
                            <h2>المؤهل العلمي والدراسات</h2>
                            <p>من فضلك اكتب الدرجة العلمية الحاصل عليها</p>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="المؤهل العلمي والدراسات"
                                       aria-label="Username"
                                       aria-describedby="basic-addon1">
                            </div>
                            <div class="col-md-4">
                                <select class="myselect">
                                    <option>العام</option>
                                    <option>2015</option>
                                    <option>2016</option>
                                    <option>2017</option>
                                    <option>2018</option>
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <h2>اللغات</h2>
                            <p>قم بإضافة تفاصيل مهارات اللغات لديك</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="اللغة الأولى" aria-label="Username"
                                       aria-describedby="basic-addon1">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="اللغة الثانية"
                                       aria-label="Username"
                                       aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h2>سنوات الخبرة</h2>
                                <p>أدخل سنوات الخبرة الخاصة بك</p>
                                <select class="myselect">
                                    <option>سنوات الخبرة</option>
                                    <option>أقل من سنة</option>
                                    <option>1-3 سنوات</option>
                                    <option>3-5 سنوات</option>
                                    <option>5-8 سنوات</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <h2>مستوى الخبرة</h2>
                                <p>اختر مستوى الخبرة الخاص بك</p>
                                <select class="myselect">
                                    <option>مستوى الخبرة</option>
                                    <option>مبتدأ الخبرة</option>
                                    <option>متوسط الخبرة</option>
                                    <option>ادارة</option>
                                    <option>ادارة عليا</option>
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <h2>الخبرات السابقة</h2>
                            <p>اضف تفاصيل الوظيفة السابقة لديك</p>
                        </div>
                        <div class="">
                            <input type="text" class="form-control" placeholder="الخبرات السابقة" aria-label="Username"
                                   aria-describedby="basic-addon1">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h2>تاريخ البدء</h2>
                            </div>
                            <div class="col-md-4 col-6">
                                <select class="myselect mt-3">
                                    <option>شهر</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-6">
                                <select class="myselect mt-3">
                                    <option>سنة</option>
                                    <option>2012</option>
                                    <option>2013</option>
                                    <option>2014</option>
                                    <option>2015</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h2>تاريخ الانتهاء</h2>
                            </div>
                            <div class="col-md-4 col-6">
                                <select class="myselect mt-3">
                                    <option>شهر</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-6">
                                <select class="myselect mt-3">
                                    <option>سنة</option>
                                    <option>2014</option>
                                    <option>2015</option>
                                    <option>2016</option>
                                    <option>2017</option>
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <div class="job-now">
                                <label class="check-label">
                                    <input type="checkbox" id="mycheck">
                                    <span>أعمل هنا حتى الآن</span>
                                </label>
                            </div>
                        </div>
                        <div class="">
              <textarea class="mytextarea" placeholder="الوصف الوظيفي" id="exampleFormControlTextarea1"
                        rows="3"></textarea>
                        </div>
                        <div class="">
                            <h2>دول ترغب العمل بها</h2>
                            <p>قم باختيار الدول التي تفضل العمل بها</p>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-3">
                                <div class="country-job">
                                    <span>1</span>
                                </div>
                            </div>
                            <div class="col-md-5 col-9">
                                <select class="myselect mt-3">
                                    <option>اختر الدولة</option>
                                    <option>مصر</option>
                                    <option>السعودية</option>
                                    <option>الكويت</option>
                                    <option>السودان</option>
                                </select>
                            </div>
                            <div class="col-md-5 col-9">
                                <select class="myselect mt-3">
                                    <option>اختر المدينة</option>
                                    <option>مصر</option>
                                    <option>السعودية</option>
                                    <option>الكويت</option>
                                    <option>السودان</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-3">
                                <div class="country-job">
                                    <span>2</span>
                                </div>
                            </div>
                            <div class="col-md-5 col-9">
                                <select class="myselect mt-3">
                                    <option>اختر الدولة</option>
                                    <option>مصر</option>
                                    <option>السعودية</option>
                                    <option>الكويت</option>
                                    <option>السودان</option>
                                </select>
                            </div>
                            <div class="col-md-5 col-9">
                                <select class="myselect mt-3">
                                    <option>اختر المدينة</option>
                                    <option>مصر</option>
                                    <option>السعودية</option>
                                    <option>الكويت</option>
                                    <option>السودان</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-3 mb-0">
                                <div class="country-job">
                                    <span>3</span>
                                </div>
                            </div>
                            <div class="col-md-5 col-9">
                                <select class="myselect mt-3">
                                    <option>اختر الدولة</option>
                                    <option>مصر</option>
                                    <option>السعودية</option>
                                    <option>الكويت</option>
                                    <option>السودان</option>
                                </select>
                            </div>
                            <div class="col-md-5 col-9">
                                <select class="myselect mt-3">
                                    <option>اختر المدينة</option>
                                    <option>مصر</option>
                                    <option>السعودية</option>
                                    <option>الكويت</option>
                                    <option>السودان</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <a class=" btn prev-btn" href="./stepper2.html">السابق</a>
                            </div>
                            <div class="col-md-6 col-6">
                                <a class=" btn next-btn" href="./jsprofile.html">حفظ</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </section>
    <!-- end personal section -->

@stop
@section('scripts')
@endsection
