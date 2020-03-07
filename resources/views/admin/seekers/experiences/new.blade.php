@extends('admin.layout')

@section('content')
 <?php
    use \App\Constants\YearsExperiences;
    use \App\Constants\EducationLevel;
    use \App\Constants\CareerLevels;
 ?>
    <div class="app-content">
        <section class="section">
            <!--page-header open-->
            <div class="row">
                <div class="col-6">
                    <div class="page-header">
                        <h4 class="page-title">{{ trans('seeker_details') }}</h4>
                        <a href="" class="btn btn-danger mt-1 mr-auto" data-toggle="modal" data-target="#exampleModalLong{{$seeker->id}}"  >{{ trans('remove') }}</a>
                    </div>
                </div>

            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ trans('seeker_details') }}</h4>
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
                                        <a class="nav-link " id="home-tab3" href="{{ route('admin.seekers.edit', ['seeker' => $seeker]) }}">{{ trans('personal_data') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="dec-tab3" href="{{ route('admin.seeker.details.edit', ['seeker' => $seeker, 'details' => $seekerDetails]) }}">{{ trans('job_details') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dec-tab4" href="#">{{ trans('experiences_and_skills') }} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="dec-tab5" href="{{ route('admin.seeker.logs', ['user' => $seeker]) }}">{{ trans('logs') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content border-top p-3">
                                    <div class="tab-pane fade show active p-0" id="doc4" role="tabpanel" aria-labelledby="dec-tab4">
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 mx-auto">
                                                <div class="card">
                                                    <form action="{{ route('admin.seeker.experiences.store',['seeker'=>$seeker->id]) }}" method="post">
                                                        @csrf
                                                    <div class="card-header">
                                                        <h4> {{ trans('experiences_and_skills') }} </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <label for="years_of_experience">{{ trans('years_of_experience') }}</label>
                                                        <div class="form-group">
                                                            <select name="years_of_experience" id="years_of_experience" class="select2 col-md-12">
                                                                <option  value="">{{ trans('select_years_of_experience') }}</option>
                                                                @foreach(YearsExperiences::getList() as $key => $value)
                                                                    <option value="{{ $key }}" {{ old("years_of_experience") == $key ? "selected":null }}>{{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('years_of_experience'))
                                                                <div class="error">
                                                                    <strong style="color:red;">{{ $errors->first('years_of_experience') }}</strong>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <label for="career_level">{{ trans('career_level') }}</label>
                                                        <div class="form-group">
                                                            <select class="select2 col-md-12" name="career_level" id="career_level">
                                                                <option  value="">{{ trans('select_career_level')  }}</option>
                                                                @foreach(CareerLevels::getList() as $key => $value)
                                                                    <option value="{{ $key }}" {{ old("career_level") == $key ? "selected":null }}>{{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="previous_experience" class="mt-3">{{ trans('previous_experience') }}</label>
                                                            <input type="text" class="form-control" name="previous_experience" id="previous_experience" value="{{old('previous_experience')}}" placeholder="{{ trans('previous_experience') }}">
                                                        </div>
                                                        @if ($errors->has('previous_experience'))
                                                                <div class="error">
                                                                    <strong style="color:red;">{{ $errors->first('previous_experience') }}</strong>
                                                                </div>
                                                        @endif
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="previous_experience_from_date">{{ trans('previous_experience_from_date') }}</label>
                                                                    <input type="date" max="<?php echo date("Y-m-d"); ?>" class="form-control" name="previous_experience_from_date" id="previous_experience_from_date" value="{{ old('previous_experience_from_date') }}" placeholder="{{ trans('previous_experience_from_date') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="previous_experience_to_date">{{ trans('previous_experience_to_date') }}</label>
                                                                    <input type="date" max="<?php echo date("Y-m-d"); ?>" class="form-control" name="previous_experience_to_date" id="previous_experience_to_date" value="{{ old('previous_experience_to_date') }}" placeholder="{{ trans('previous_experience_to_date') }}">
                                                                </div>
                                                            </div>
                                                        </div>
{{--                                                        <div class="form-group">--}}
{{--                                                            <label for="previous_experience" class="mt-3">{{ trans('previous_experience') }}</label>--}}
{{--                                                            <input type="text" class="form-control" name="previous_experience" id="previous_experience" placeholder="{{ trans('previous_experience') }}">--}}
{{--                                                            <div class="form-group mt-3">--}}
{{--                                                                <label>{{ trans('date') }}</label>--}}
{{--                                                                <div class="input-group">--}}
{{--                                                                    <div class="input-group-addon">--}}
{{--                                                                        <i class="fa fa-calendar"></i>--}}
{{--                                                                    </div>--}}
{{--                                                                    <input type="text" name="previous_experience_from_date" id="previous_experience_from_date" class="form-control pull-right" id="reservation">--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                        <div class="col-lg-12 col-md-12">
                                                            <label for="education_level">{{ trans('education_level') }}</label>
                                                            <div class="form-group">
                                                                <select class="select2 col-md-12" name="education_level" id="education_level">
                                                                    <option  value="">{{ trans('select_education_level') }}</option>
                                                                    @foreach(EducationLevel::getList() as $key => $value)
                                                                        <option value="{{ $key }}" {{ old("education_level") == $key ? "selected":null }}>{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <label for="languages">{{ trans('languages') }}</label>
                                                        <select multiple="multiple" class="multi-select" name="languages[]" id="languages">
                                                            @foreach($languages as $language)
                                                                <option value="{{ $language->id }}" {{ old("languages") == $language->id ? "selected":null }}>{{ $language->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <label for="working_countries" class="mt-3">{{ trans('preferred_country_of_work') }}</label>
                                                        <select name="working_countries[]" id="working_countries" multiple="multiple" class="multi-select mb-3">
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country->id }}" {{ old("working_countries") == $country->id ? "selected":null }}>{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="card-footer">
                                                        <input type="submit" class="btn btn-primary mt-1" value="{{ trans('save') }}">
                                                        <input type="reset" class="btn btn-danger mt-1" value="{{ trans('reset') }}">
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
            </div>
        </section>
        <div class="modal fade" id="exampleModalLong{{ $seeker->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('delete')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.seekers.destroy', ['seeker' => $seeker]) }}" method="Post" >
                        @method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <p class="mb-0">{{trans('delete_confirmation_message')}}</p>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"> {{trans('delete')}}</button>

                            <button type="button" class="btn btn-success" data-dismiss="modal">{{trans('close')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
    </script>
@endsection
