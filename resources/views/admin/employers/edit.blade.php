@extends('admin.layout')
<?php use App\Constants\UserTypes;?>
@section('content')
    <!--app-content open-->
    <div class="app-content">
        <section class="section">
            <!--page-header open-->
            <div class="row">
                <div class="col-6">
                    <div class="page-header">
                        <h4 class="page-title"> {{ trans('new_employer') }}</h4>

                    </div>
                </div>

            </div>
            <!--page-header closed-->

            <div class="section-body">
                <!--row open-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ trans('employer_details') }}</h4>
                            </div>
                            <div class="card-body">
                                @if(session()->has('success'))
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
                                @endif
                                <ul class="nav nav-pills pb-3" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab3"
                                           href="{{ route('admin.employers.edit', ['employer' => $employer]) }}"
                                           role="tab" aria-controls="home"
                                           aria-selected="true">{{ trans('personal_data') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        @if ($employerDetails)
                                            <a class="nav-link" id="dec-tab4"
                                               href="{{ route('admin.employer.details.edit',['employer' => $employer, 'details' => $employerDetails]) }}"
                                               role="tab" aria-controls="contact"
                                               aria-selected="false">{{ trans('company_data') }}</a>
                                        @else
                                            <a class="nav-link" id="dec-tab4"
                                               href="{{ route('admin.employer.details.create',['employer'=>$employer]) }}"
                                               role="tab" aria-controls="contact"
                                               aria-selected="false">{{ trans('company_data') }}</a>
                                        @endif
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.employer.logs', ['employer' => $employer]) }}" >{{ trans('logs') }}</a>
                                    </li>
                                </ul>


                                <div class="tab-content border-top p-3">
                                    <div class="tab-pane fade show active p-0" id="home3" role="tabpanel"
                                         aria-labelledby="home-tab3">

                                        <div class="row">

                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-auto ">
                                                <div class="card">
                                                    <form
                                                        action="{{ route('admin.employers.update', ['employer' => $employer]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method("Put")


                                                        <div class="card-header">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <h4>{{ trans('personal_data') }}</h4>
                                                                </div>


                                                            </div>
                                                        </div>

                                                        <div class="card-body">
                                                            <div class="row">

                                                                <div class="col-lg-6 col-md-12">

                                                                    <div class="form-group ">
                                                                        <label
                                                                            for="exampleInputname"> {{ trans('first_name') }}</label>

                                                                        <input type="text" class="form-control"
                                                                               name="first_name" id="first_name"
                                                                               value="{{old('first_name', $employer->first_name)}}"
                                                                               placeholder="{{ trans('first_name') }} ">
                                                                       <input type="hidden" class="form-control"
                                                                        name="type" id="name" value="{{UserTypes::OWNER}}">

                                                                        <input type="hidden" name="id"
                                                                               value="{{ $employer->id}}"/>
                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-6 col-md-12">


                                                                    <div class="form-group ">
                                                                        <label
                                                                            for="exampleInputname">{{ trans('last_name') }}</label>

                                                                        <input type="text" class="form-control"
                                                                               name="last_name" id="last_name"
                                                                               value="{{old('last_name', $employer->last_name)}}"
                                                                               placeholder="{{ trans('last_name') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">

                                                                    <div class="form-group">
                                                                        <fieldset>
                                                                            <label
                                                                                for="country_key">{{ trans('country_key') }}</label>
                                                                            <select name="country_key" id="country_key"
                                                                                    class="select2 col-md-12">
                                                                                <option
                                                                                    value="">{{ trans('select_country_key') }}</option>
                                                                                @foreach($locations as $location)
                                                                                    <option
                                                                                        value="{{ $location->id }}" {{ $location->id == old( 'country_key', $employer->country_key) ? "selected":null }}>{{ $location->name }}
                                                                                        - {{ $location->code }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @if ($errors->has('country_key'))
                                                                             <strong  style="color:red;">{{ $errors->first('country_key') }}</strong>
                                                                            @endif

                                                                        </fieldset>
                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <fieldset>
                                                                            <label
                                                                                for="phone">{{ trans('phone') }}</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="phone" id="phone"
                                                                                   value="{{ old('phone', $employer->phone) }}"
                                                                                   placeholder="{{trans('phone')}}"/>
                                                                            @if ($errors->has('phone'))

                                                                                <strong  style="color:red;">{{ $errors->first('phone') }}</strong>

                                                                            @endif
                                                                        </fieldset>
                                                                    </div>
                                                                </div>

                                                            </div>


                                                            <div class="form-group">
                                                                <label for="email">{{ trans('email') }}</label>
                                                                <input type="text" class="form-control" name="email"
                                                                       id="email"
                                                                       value="{{ old('email',$employer->email) }}"
                                                                       placeholder="{{ trans('email') }}">
                                                                @if ($errors->has('email'))
                                                                    <strong  style="color:red;">{{ $errors->first('email') }}</strong>
                                                                @endif
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="password">{{ trans('password') }}</label>
                                                                <input type="password" class="form-control"
                                                                       name="password" id="password"
                                                                       value="{{ old('password') }}"
                                                                       placeholder="{{ trans('password') }}">
                                                                @if ($errors->has('password'))

                                                                    <strong  style="color:red;">{{ $errors->first('password') }}</strong>

                                                                @endif
                                                            </div>

                                                            </fieldset>
                                                        </div>
                                                        <div class="card-footer">
                                                            <input type="submit" class="btn btn-primary mt-1"
                                                                   value="{{ trans('edit') }}">
                                                            <input type="reset" class="btn btn-danger mt-1"
                                                                   value="{{ trans('reset') }}">
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!--row closed-->
            </div>

        </section>


    </div>
    <!--app-content closed-->
@stop
