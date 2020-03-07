@extends('owner.layout')
@section('content')
    <?php
    use \App\Constants\YearsExperiences;
    use \App\Constants\CareerLevels;
    ?>
    <!-- start header -->
    <section class="stepper">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-6">
                    <div class="stepper-number">
                        <h2 class="head">{{trans('edit_job')}}</h2>
                    </div>
                </div>
                <!-- <span class="stepper-span"></span> -->

            </div>
        </div>
    </section>
    <!-- end header -->

    <!-- start personal section -->
    <section class="personal">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-0">
                    <form action="{{ route('owner.users.jobs.update',['user'=>auth()->user()->id,'job'=>$job]) }}"
                          method="post">
                        @csrf
                        @method("Put")
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <div class="col-12">
                            <h2>{{trans('job_title')}}</h2>
                            <p>{{trans('place_your_job_title_available_for_your')}}</p>

                            @php
                                $error_class_title='';
                            @endphp
                            @if ($errors->has('title'))
                                @php
                                    $error_class_title='error';
                                @endphp
                                <span class="error-msg">
                                    <i class="fa fa-caret-right"></i>{{ $errors->first('title') }}
                                </span>
                            @endif
                            <input type="text" name="title" value="{{ old('title', $job->title) }}"
                                   class="form-control {{$error_class_title}}" placeholder="{{trans('job_title')}}">
                        </div>


                        <div class="col-12">
                            <h2>{{trans('industries')}}</h2>
                            <p>{{trans('type_the_areas_of_work_related_to_the_job')}}</p>

                            @php
                                $error_class_industry_id='';
                            @endphp
                            @if ($errors->has('industry_id'))
                                @php
                                    $error_class_industry_id='error';
                                @endphp
                                <span class="error-msg">
                                    <i class="fa fa-caret-right"></i>{{ $errors->first('industry_id') }}
                                </span>
                            @endif

                            <select class="myselect {{$error_class_industry_id}}" name="industry_id" id="industry_id">
                                <option selected value="">{{ trans('select_industries') }}</option>
                                @foreach($industries as $industry)
                                    <option
                                        value="{{ $industry->id }}" {{ $industry->id == old('industry_id', $job->industry_id) ? "selected" : null }} >{{ $industry->name }}</option>
                                @endforeach
                            </select>


                        </div>
                        <div class="col-12">
                            <h2>{{ trans('select_roles') }}</h2>
                            <p>{{ trans('add_job_tasks_advertised_here_with_a_maximum_of_5_tasks') }}</p>
                        </div>
                        <div class="col-12">
                            <div class="box-card">

                                <div id="roles_div">
                                    <select multiple name="roles[]" class="form-control" id="selectRoles">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}"
                                                    @if($job->roles->containsStrict('id', $role->id)) selected="selected" @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>{{ trans('years_of_experience') }}</h2>
                                    <p> {{ trans('select_years_of_experience') }}</p>

                                    <select class="myselect" name="years_of_experience">
                                        <option value="">{{ trans('select_years_of_experience') }}</option>
                                        @foreach(YearsExperiences::getList() as $key => $value)
                                            <option
                                                value="{{ $key }}" {{ old("years_of_experience", $job->years_of_experience) == $key ? "selected":null }}>{{ $value }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <h2>{{ trans('career_level') }}</h2>
                                    <p> {{ trans('select_career_level')  }}</p>

                                    <select class="myselect" name="career_level">
                                        <option value="">{{ trans('select_career_level')  }}</option>
                                        @foreach(CareerLevels::getList() as $key => $value)
                                            <option
                                                value="{{ $key }}" {{ old("career_level", $job->career_level) == $key ? "selected":null }}>{{ $value }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <h2> {{ trans('country') }}</h2>
                                    <p> {{ trans('select_country') }}</p>

                                    <select class="myselect" name="location_id" id="parent_location">
                                        <option selected value="">{{ trans('select_country') }}</option>
                                        @foreach($countries as $country)
                                            <option
                                                value="{{ $country->id }}" {{ ($country->id  == old('country_id', $job->location_id) || $country->id  == old('country_id', optional(@$job->location->parent)->id)) ? "selected" : null }} >{{ $country->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <h2>{{ trans('city') }} </h2>
                                    <p> {{ trans('select_city') }}</p>

                                    <select class="myselect" id="location_id" name="city_id">
                                        <option selected value="">{{ trans('select_city') }}</option>
                                        @foreach($cities as $city)
                                            <option
                                                value="{{ $city->id }}" {{ $city->id == old('city_id', $job->location_id) ? "selected" : null }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6 col-6 ">
                                <button type="submit" class=" btn next-btn">{{ trans('add') }}</button>
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

    <script src="{{ url('assets/web/js/select2.min.js') }}"></script>

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
