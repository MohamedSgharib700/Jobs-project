@extends('web.layout')

@section('content')
    <?php
       use\App\Constants\CompanySize;
       use App\Constants\UserTypes;
    ?>
    <section class="personal">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="row">
                        <div class="col-12">
                            <div class="personal-header">
                                <h2>تفاصيل شركتك</h2>
                                <p>ضع المعلومات الأساسية عن شركتك هناة</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @if(Session::has('message'))
                            <h3><td> <p class="preloader-wrapper big active {{ Session::get('alert-class', 'alert-info') }}"> {{ Session::get('message') }} </p></td></h3>
                        @endif

                        <form class="col-12" method="post" action="{{ route('owner.users.companies.store',['employer'=>auth()->user()]) }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

                            <div class="row">
                                <div class="col-12">
                                    <h2>المسمى الوظيفى</h2>
                                    <p>ما هو المسمى الوظيفي لك داخل الشركة ؟</p>
                                    <input type="text" class="form-control" name="job_title" placeholder="المسمى الوظيفى" aria-label="Username" aria-describedby="basic-addon1">
                                    @if ($errors->has('job_title'))
                                        <span class="error-msg"> <i class="fa fa-caret-right"></i>{{ $errors->first('job_title') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <h2>اسم الشركة</h2>
                                    <p>اكتب اسم شركتك هنا</p>
                                    <input type="text" class="form-control" name="company_name" placeholder="اسم الشركة" aria-label="Username" aria-describedby="basic-addon1">
                                    @if ($errors->has('company_name'))
                                        <span class="error-msg"> <i class="fa fa-caret-right"></i>{{ $errors->first('company_name') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <h2>مجال الشركة</h2>
                                    <select class="select2 col-md-12 myselect" name="industry_id">
                                        <option value="" selected>{{ trans('select_company_industry') }}</option>
                                        @foreach($industries as $industry)

                                            <option value="{{ $industry->id }}" {{ (old("industry_id") == $industry->id) ? "selected":null }}>{{ $industry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h2>حجم الشركة</h2>
                                    <p>اختر حجم العمل داخل الشركة</p>
                                    <select class="myselect" name="company_size">
                                        @foreach(CompanySize::getList() as $key => $value)
                                            <option value="{{ $key }}" {{ old("company_siz") == $key? "selected":null }}>{{ $value }}</option>
                                        @endforeach
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h2>موقع الشركة</h2>
                                    <p>اختر موقع شركتك من هنا</p>
                                    <select class="myselect" name="location_id">
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id}}" >{{ $location->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <input class=" btn next-btn" type="submit" value="التالي ">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
    </section>

    @stop
