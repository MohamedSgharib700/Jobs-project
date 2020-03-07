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
                                <h2>{{trans('employer_details')}} </h2>
                                <p>{{ trans('put_your_company_data_here') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @if(Session::has('message'))
                            <h3><td> <p class="preloader-wrapper big active {{ Session::get('alert-class', 'alert-info') }}"> {{ Session::get('message') }} </p></td></h3>
                        @endif

                        <form class="col-12" method="post" action="{{ route('owner.users.companies.update',['employer' => $employer, 'employerDetails' => $employerDetails]) }}">
                            @csrf
                            @method("Put")

                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

                            <div class="row">
                                <div class="col-12">
                                    <h2> {{trans('job_title')}}</h2>
                                    <p>{{trans('what_is_your_job_title_inside_your_company')}}</p>
                                    <input type="text" class="form-control" name="job_title" placeholder="{{trans('job_title')}}" aria-label="Username" aria-describedby="basic-addon1"
                                           value="{{$employerDetails->job_title}}">
                                    @if ($errors->has('job_title'))
                                        <span class="error-msg"> <i class="fa fa-caret-right"></i>{{ $errors->first('job_title') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <h2> {{trans('company_name')}}</h2>
                                    <p>{{trans('write_your_company_name_here')}}</p>
                                    <input type="text" class="form-control" name="company_name" placeholder="{{trans('company_name')}}" aria-label="Username" aria-describedby="basic-addon1"
                                     value="{{$employerDetails->company_name}}" >
                                    @if ($errors->has('company_name'))
                                        <span class="error-msg"> <i class="fa fa-caret-right"></i>{{ $errors->first('company_name') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <h2>{{trans('company_industry')}}</h2>
                                    <select class="select2 col-md-12 myselect" name="industry_id">
                                        <option value="" selected>{{ trans('select_company_industry') }}</option>
                                        @foreach($industries as $industry)
                                            <option
                                                value="{{ $industry->id }}" {{ (($industry->id == $employerDetails->industry_id) || ($industry->id == old( 'industry_id'))) ? "selected":null }}>{{ $industry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h2> {{trans('company_size')}}</h2>
                                    <p>  {{trans('select_company_size')}}</p>
                                    <select class="myselect" name="company_size">
                                        @foreach(CompanySize::getList() as $key => $value)
                                            <option
                                                value="{{ $key }}" {{ (($employerDetails->company_size== $key) || (old("company_size") == $key) ) ? "selected":null }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h2>{{trans('company_location')}}</h2>
                                    <p>{{trans('select_company_location')}}</p>
                                    <select class="myselect" name="location_id">
                                        @foreach($locations as $location)
                                            <option
                                                value="{{ $location->id }}" {{ ($location->id == old( 'location_id')|| $location->id ==  $employerDetails->location_id )? "selected":null }}>{{ $location->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
 
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <input class=" btn next-btn" type="submit" value="{{trans('next')}}">
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
