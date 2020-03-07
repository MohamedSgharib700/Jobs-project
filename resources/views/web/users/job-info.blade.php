@extends('web.layout')

@section('content')
<?php
    use \App\Constants\AgeRange;
    use \App\Constants\MaritalStatus;
    use \App\Constants\MilitaryStatus;
?>

<section class="stepper d-none d-xl-block d-lg-block ">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-3">
                <div class="stepper-number">
                    <span>1</span>
                </div>
                <div class="stepper-span2 d-none d-sm-block"></div>
            </div>
            <div class="col-md-4 col-6">
                <div class="stepper-number">
                    <span>2</span>
                    <h2>{{ trans('job_info') }}</h2>
                </div>
                <div class="stepper-span d-none d-sm-block"></div>
            </div>
            <div class="col-md-2 col-3">
                <div class="stepper-number2">
                    <span>3</span>
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
                <div class="stepper-span"></div>
            </div>
            <div class="col-md-3 col-4">
                <div class="stepper-number2 ">
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
                <div class="col-12">
                <div class="row">
                    <div class="personal-header">
                        <h2>{{ trans('job_info') }}</h2>
                        <p>{{ trans('please_enter_job_info') }}</p>
                    </div>
                    </div>
                </div>
                <form action="{{ route('web.seeker.store.job.info') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-12">
                        <h2>{{ trans('job') }}</h2>
                        <p>{{ trans('what_is_your_job') }}</p>
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="form-control  @if($errors->has('job_title')) error @endif" name="job_title" id="job_title" value="{{ old('job_title', $seeker->job_title) }}" placeholder="{{ trans('job_title_must_be_more_than_3') }}">
                        @error('job_title')
                        <span class="error-msg"><i class="fa fa-caret-right"></i>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <h2>{{ trans('industries') }}</h2>
                        <p>{{ trans('select_industries') }}</p>
                    </div>
                    <div class="col-md-12">
                        <div id="seeker-industries-container" style="display: none"></div>
                        <div class="popup-jobs @if ($errors->has('industry_id')) error @endif" data-toggle="modal" data-target="#exampleModalCenter3">
                            <p>{{ trans('select_with_max_3_items') }}</p>
                        </div>
                        @error('industry_id')
                        <span class="error-msg"><i class="fa fa-caret-right"></i>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <h2>{{ trans('roles') }}</h2>
                        <p>{{ trans('select_your_roles') }}</p>
                        <div id="seeker-roles-container" style="display: none"></div>
                    </div>
                    <div class="col-12">
                        <div class="box-card @if ($errors->has('roles')) error @endif" id="roles-box">
                        </div>
                        @error('roles')
                        <span class="error-msg"><i class="fa fa-caret-right"></i>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <h2>{{ trans('skills') }}</h2>
                        <p>{{ trans('write_down_your_skills') }}</p>
                    </div>
                    <div class="col-12">
                        <select multiple name="skills[]" class="form-control @if($errors->has('skills')) error @endif" id="selectEvents">
                            @foreach($skills as $skill)
                                <option value="{{ $skill->id }}">{{ $skill->title }}</option>
                            @endforeach
                        </select>
                        @error('skills')
                        <span class="error-msg"><i class="fa fa-caret-right"></i>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <h2>{{ trans('social_cv') }}</h2>
                        <p>{{ trans('enter_social_cv') }}</p>
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="form-control @if($errors->has('social_account')) error @endif" name="social_account" id="social_account" value="{{ old('social_account') }}" placeholder="{{ trans('face_linkedin_instagram') }}">
                        @error('social_account')
                        <span class="error-msg"><i class="fa fa-caret-right"></i>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <h2>{{ trans('cv') }}</h2>
                        <p>{{ trans('upload_your_cv') }}</p>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="file" class="form-control-file pt-3" name="cv" id="exampleFormControlFile1" onchange="return imageLoader(this)">
                        </div>
                        <div class="progress">
                            <div class="progress-bar" id="progressTimer" role="progressbar" style="width: 100%;" aria-valuenow="25"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!-- <div class="row"> -->
                        <div class="col-md-6 col-6">
                            <a class=" btn prev-btn" href="{{ route('web.seeker.personal.info') }}">{{ trans('previous') }}</a>
                        </div>
                        <div class="col-md-6 col-6">
                            <button type="submit" class="btn next-btn">{{ trans('next') }}</button>
                        </div>
                    <!-- </div> -->
                    </div>
                </form>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
</section>
<div class="modal fade choose-model" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <form>
                            <div class="col-12">
                                <h2>{{ trans('select_your_industries_details') }}</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="job-box">
                                        <div class="job-header">
                                            <h3>{{ trans('job_field') }}</h3>
                                        </div>
                                        <div class="job-name">
                                            <div class="row industry-container">
                                                @foreach ($industries as $industry)
                                                <div class="col-12">
                                                    <label class="check-label">
                                                        <input type="checkbox" value="{{ $industry->id }}" class="mycheck industry-checkbox" id="industry-checkbox{{$industry->id}}">
                                                        <span>{{ $industry->name }}</span>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="job-box">
                                        <div class="job-header">
                                            <label class="input-serch" for=""><i class="fa fa-search"></i>
                                                <input placeholder="{{ trans('search_in_roles') }}">
                                            </label>
                                        </div>
                                        <div class="job-name">
                                            <div class="row roles-container" id="roles-container">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="job-box">
                                        <div class="job-header">
                                            <h3>{{ trans('select_6_roles') }}<span>6/<label id="roles-count">0</label></span></h3>
                                        </div>
                                        <div class="job-name">
                                            <div class="row final-roles-container" id="final-roles-container">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-8 mt-5 mr-auto">
                                    <a class=" btn save-btn" href="#">{{ trans('save') }}</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(".industry-checkbox").change(function() {
            if(this.checked) {
                if (countIndustries() <= 3) {
                    var industries = [this.value];
                    $.ajax({
                        url: '{{ route("api.roles.index") }}',
                        type: 'get',
                        data: {_token: '{{ csrf_token() }}', 'industries': industries},
                        success: function (data) {
                            var html = '<div class="col-12" id="roles' + data[0].parent_id + '"><input type="hidden" class="test">';
                            var html2 = '<div class="col-12" id="final-roles' + data[0].parent_id + '"><input type="hidden" class="test">';
                            var htmlRolesBox = '';
                            var i;
                            for (i = 0; i < data.length; i++) {
                                html += '<div class="col-12 mid-roles-div">\n' +
                                    '       <label class="check-label">\n' +
                                    '       <input type="checkbox" value="' + data[i].id + '" class="mycheck role-checkbox" id="check-role' + data[i].id + '" data-parent="' + data[i].parent_id + '">\n' +
                                    '       <span>' + data[i].name + '</span>\n' +
                                    '       </label>\n' +
                                    '      </div>';
                                html2 += '<div class="col-12 final-roles-div" id="final-role' + data[i].id + '" style="display: none">\n' +
                                    '       <label class="check-label">\n' +
                                    '       <input type="checkbox" value="' + data[i].id + '" class="mycheck final-role-checkbox" id="check-final-role' + data[i].id + '">\n' +
                                    '       <span>' + data[i].name + '</span>\n' +
                                    '       </label>\n' +
                                    '      </div>';
                                htmlRolesBox += '<div class="skils-card2 role-box' + data[i].parent_id + '" id="role-box' + data[i].id + '" style="display: none">\n' +
                                    '               <span>' + data[i].name + '</span>\n' +
                                    '            </div>';

                            }
                            html += '</div>';
                            html2 += '</div>';

                            $('#roles-container').append(html);
                            $('#final-roles-container').append(html2);
                            $('#roles-box').append(htmlRolesBox);

                        },
                        error: function () {
                            alert("error");
                        }
                    });

                    $('#seeker-industries-container').append('<input type="checkbox" name="industry_id[]" id="seeker-industry' + this.value + '" value="' + this.value + '" checked>');
                } else {
                    $(this).prop('checked', false);
                    $.dialog({
                        title: '{{trans('alert')}}!',
                        content: '{{ trans('max_industries_is_3') }} !',
                    });
                }
            } else {
                $('#roles'+this.value+'').remove();
                $('#final-roles'+this.value+'').remove();
                $('.role-box'+this.value+'').remove();
                $('#seeker-industry'+this.value+'').remove();
                $('.seeker-role'+this.value+'').remove();

            }
            $('#roles-count').text(countFinalRoles());
        });

        $(document).arrive(".test", function() {
            $(".role-checkbox").change(function() {
                if(this.checked) {
                    if (countMidRoles() <= 4) {
                        var parentID = $(this).attr('data-parent');
                        $('#check-final-role'+this.value+'').prop('checked', true);
                        $('#final-role'+this.value+'').show();
                        $('#role-box'+this.value+'').show();
                        $('#roles-count').text(countFinalRoles());
                        $('#seeker-roles-container').append('<input type="checkbox" class="seeker-role'+parentID+'" name="roles[]" id="seeker-role'+this.value+'" value="'+this.value+'" checked>');
                    } else {
                        $(this).prop('checked', false);
                        $.dialog({
                            title: '{{trans('alert')}}!',
                            content: '{{ trans('max_roles_is_6') }} !',
                        });
                    }

                } else {
                    $('#check-final-role'+this.value+'').prop('checked', false);
                    $('#final-role'+this.value+'').hide();
                    $('#role-box'+this.value+'').hide();
                    $(this).attr('checked', false);
                    $('#roles-count').text(countFinalRoles());
                    $('#seeker-role'+this.value+'').remove();
                }
            });
            $(".final-role-checkbox").change(function() {
                if(!this.checked) {
                    $(this).attr('checked', false);
                    $('#final-role'+this.value+'').hide();
                    $('#role-box'+this.value+'').hide();
                    $('#check-role'+this.value+'').prop('checked', false);
                    $('#roles-count').text(countFinalRoles());
                    $('#seeker-role'+this.value+'').remove();
                }
            });
        });
        //////////////////////////////////////////////////////////////
        function countFinalRoles() {
            return $(".final-roles-div input[type=checkbox]:checked").length;
        }
        function countMidRoles() {
            return $(".mid-roles-div input[type=checkbox]:checked").length;
        }
        function countIndustries() {
            return $(".industry-container input[type=checkbox]:checked").length;
        }
        //////////////////////////////////////////////////////////////
        var s2 = $("#selectEvents").select2({
            //placeholder: "{{ trans('write_your_skills') }}",
            tags: true
        });
        var vals = [];

        vals.forEach(function(e){
            if(!s2.find('option:contains(' + e + ')').length)
                s2.append($('<option>').text(e));
        });
        s2.val(vals).trigger("change");
    </script>

@endsection
