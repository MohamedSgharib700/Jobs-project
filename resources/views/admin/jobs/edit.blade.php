@extends('admin.layout')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" rel="stylesheet"/>
@section('content')
    <?php
    use \App\Constants\YearsExperiences;
    use \App\Constants\EducationLevel;
    use \App\Constants\CareerLevels;

    use App\Models\Location;

    ?>
    <div class="app-content">
        <section class="section">
            <div class="row">
                <div class="col-6">
                    <div class="page-header">
                        <h4 class="page-title">{{ trans('jobs') }}   </h4>

                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ trans('jobs') }}</h4>
                            </div>
                            <div class="card-body">
                                @include('admin.errors')
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

                                <div class="tab-content border-top p-3">
                                    <div class="tab-pane fade show active  p-0" id="doc3" role="tabpanel"
                                         aria-labelledby="dec-tab3">
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 mx-auto">
                                                <div class="card">
                                                    <form action="{{ route('admin.jobs.update', ['job' => $job]) }}"
                                                          method="post" enctype="multipart/form-data"
                                                          id="horizontal-validation" class="form-horizontal">
                                                        @csrf
                                                        @method("Put")
                                                        <div class="card-header">
                                                            <h4>{{ trans('job') }}</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-md-12">
                                                                    <label for="title">{{ trans('job_title') }}</label>

                                                                    <input type="text" class="form-control" name="title"
                                                                           id="title"
                                                                           value="{{ old('title', $job->title) }}">

                                                                </div>

                                                                <div class="col-lg-12 col-md-12 industry">
                                                                    <label
                                                                        for="industry_id">{{ trans('select_industries') }}</label>
                                                                    <select name="industry_id" class="form-control"
                                                                            id="industry_id">
                                                                        <option>{{ trans('select_industries') }}</option>
                                                                        @foreach($industries as $industry)


                                                                            <option
                                                                                value="{{ $industry->id }}" {{ $industry->id == old('industry_id', $job->industry_id) ? "selected" : null }}>{{ $industry->name }}</option>

                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-lg-12 col-md-12 form-group">
                                                                    <label
                                                                        for="roles">{{ trans('select_roles') }}</label>
                                                                    <select multiple name="roles[]" class="form-control"
                                                                            id="selectRoles">
                                                                        @foreach($roles as $role)
                                                                            <option value="{{ $role->id }}"
                                                                                    @if($job->roles->containsStrict('id', $role->id)) selected="selected" @endif>{{ $role->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                                <div class="col-lg-12 col-md-12 form-group">
                                                                    <label
                                                                        for="years_of_experience">{{ trans('years_of_experience') }}</label>
                                                                    <select name="years_of_experience"
                                                                            id="years_of_experience"
                                                                            class="select2 col-md-12">
                                                                        <option
                                                                            value="">{{ trans('select_years_of_experience') }}</option>
                                                                        @foreach(YearsExperiences::getList() as $key => $value)
                                                                            <option
                                                                                value="{{ $key }}" {{ old("years_of_experience", $job->years_of_experience) == $key ? "selected":null }}>{{ $value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('years_of_experience'))
                                                                        <div class="error">
                                                                            <strong
                                                                                style="color:red;">{{ $errors->first('years_of_experience') }}</strong>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                <div class="col-lg-12 col-md-12 form-group">
                                                                    <label
                                                                        for="education_level">{{ trans('career_level') }}</label>
                                                                    <select class="select2 col-md-12"
                                                                            name="career_level"
                                                                            id="career_level">
                                                                        <option
                                                                            value="">{{ trans('select_career_level')  }}</option>
                                                                        @foreach(CareerLevels::getList() as $key => $value)
                                                                            <option
                                                                                value="{{ $key }}" {{ old("career_level", $job->career_level) == $key ? "selected":null }}>{{ $value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                                <div class="col-lg-12 col-md-12 form-group"
                                                                     id="country">

                                                                    <label for="parent">{{trans('country')}}</label>


                                                                    <select name="country_id" id="parent"
                                                                            class="form-control select2 w-100" z>
                                                                        <option
                                                                            value="">{{ trans('select_country') }}</option>
                                                                        @foreach($countries as $country)
                                                                            <option
                                                                                value="{{ $country->id }}" {{ ($country->id  == old('country_id', $job->location_id) || $country->id  == old('country_id', optional($job->location->parent)->id)) ? "selected" : null }} >{{ $country->name }}</option>
                                                                        @endforeach
                                                                    </select>


                                                                </div>


                                                                <div class="col-lg-12 col-md-12 form-group" id="city">

                                                                    <label for="location_id">{{trans('city')}}</label>
                                                                    <select name="city_id" id="location_id"
                                                                            class="form-control select2 w-100">
                                                                        <option value="">Select City</option>
                                                                        @foreach($cities as $city)
                                                                            <option
                                                                                value="{{ $city->id }}" {{ $city->id == old('city_id', $job->location_id) ? "selected" : null }}>{{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="card-footer">
                                                            <input type="submit" class="btn btn-primary mt-1"
                                                                   value="{{ trans('next') }}">
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
            </div>
        </section>

    </div>
@stop
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#industry_id').change(function (event) {

                var lang = '{{ app()->getLocale() }}';
                var industries = [];
                var select = document.getElementById("industry_id");
                var count = 0;
                for (var i = 0; i < select.options.length; i++) {
                    if (select.options[i].selected) {
                        count++;
                    }
                }
                if (count == 0) {
                    $('#selectRoles').html('');
                }
                $.each($("#industry_id option:selected"), function () {
                    industries.push($(this).val());

                    $.ajax({
                        url: '{{ route("api.roles.index") }}',
                        type: 'get',
                        data: {_token: '{{ csrf_token() }}', 'industries': industries},
                        success: function (data) {
                            if (data.length > 0) {
                                $('#roles_div').show();
                                let i;
                                let html = '';
                                for (i = 0; i < data.length; i++) {
                                    if (lang == 'ar') {
                                        html += '<option value ="' + data[i].id + '">' + data[i].translations[0].name + '</option>';
                                    } else {
                                        html += '<option value ="' + data[i].id + '">' + data[i].translations[1].name + '</option>';
                                    }

                                }
                                $('#selectRoles').html(html);

                                let s3 = $("#selectRoles").select2({
                                    //tags: true
                                });
                                var vals2 = [];

                                vals2.forEach(function (e) {
                                    if (!s3.find('option:contains(' + e + ')').length)
                                        s3.append($('<option>').text(e));
                                });
                                s3.val(vals2).trigger("change");
                            }
                        },
                        error: function () {
                            alert("error");
                        }
                    });
                });
            });
        });


    </script>

    <script>
        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        let s3 = $("#selectRoles").select2({
            //tags: true
        });
        var vals2 = '{{ $job->roles }}';

        vals2.forEach(function (e1) {
            if (!s3.find('option:contains(' + e1 + ')').length)
                s3.append($('<option>').text(e1));
        });
        s3.val(vals2).trigger("change");

    </script>

@endsection
