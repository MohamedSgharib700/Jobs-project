@extends('admin.layout')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" rel="stylesheet"/>
@section('content')
 <?php
    use \App\Constants\AgeRange;
    use \App\Constants\MaritalStatus;
    use \App\Constants\MilitaryStatus;
 ?>
    <div class="app-content">
        <section class="section">
            <div class="row">
                <div class="col-6">
                    <div class="page-header">
                        <h4 class="page-title">{{ trans('seeker_details') }}   </h4>
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
                                        <a class="nav-link " href="{{ route('admin.seekers.edit', ['seeker' => $seeker]) }}">{{ trans('personal_data') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dec-tab3" href="#">{{ trans('job_details') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" >{{ trans('experiences_and_skills') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"  href="{{ route('admin.seeker.logs', ['user' => $seeker]) }}" >{{ trans('logs') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content border-top p-3">
                                    <div class="tab-pane fade show active  p-0" id="doc3" role="tabpanel" aria-labelledby="dec-tab3">
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 mx-auto">
                                                <div class="card">
                                                    <form action="{{ route('admin.seeker.details.store', ['seeker'=>$seeker]) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                    <div class="card-header">
                                                        <h4>{{ trans('job_details') }}</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label for="job_title">{{ trans('job_title') }}</label>
                                                                    <input type="hidden" name="user_id" value="{{ $seeker->id }}">
                                                                    <input type="text" class="form-control" name="job_title" id="job_title" value="{{ old('job_title') }}" placeholder="{{ trans('job_title') }}">
                                                                    @if ($errors->has('job_title'))
                                                                        <div class="error">
                                                                            <strong>{{ $errors->first('job_title') }}</strong>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12 industry" >
                                                                <label for="industry_id">{{ trans('select_industries') }}</label>
                                                                <select name="industry_id[]" id="industry_id" multiple="multiple" class="multi-select">
                                                                    @foreach($industries as $industry)
                                                                        <option value="{{ $industry->id }}" {{ in_array($industry->id, (array)old('industry_id')) ? "selected":null }}>{{ $industry->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div id="roles_div" style="display: none">
                                                                <label for="roles">{{ trans('select_roles') }}</label>
                                                                <select multiple name="roles[]" class="form-control" id="selectRoles">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="roles">{{ trans('enter_skills') }}</label>
                                                                <select multiple name="skills[]" class="form-control" id="selectEvents">
                                                                    @foreach($skills as $skill)
                                                                        <option value="{{ $skill->id }}">{{ $skill->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="social_account">{{trans('social_account')}}</label>
                                                            <input type="text" name="social_account" id="social_account" value="{{ old('social_account') }}" class="form-control" placeholder="{{trans('social_account')}}">
                                                            @if ($errors->has('social_account'))
                                                                <div class="error">
                                                                    <strong>{{ $errors->first('social_account') }}</strong>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cv">{{ trans('cv') }} </label>
                                                            <input type="file" class="form-control1" name="cv">
                                                            @if ($errors->has('cv'))
                                                                <div class="error">
                                                                    <strong>{{ $errors->first('cv') }}</strong>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <input type="submit" class="btn btn-primary mt-1" value="{{ trans('next') }}">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.industry .multi-select').find('input[type=checkbox]').change(function(event) {
                var lang = '{{ app()->getLocale() }}';
                var industries = [];
                var select = document.getElementById("industry_id");
                var count = 0;
                for (var i = 0; i < select.options.length; i++) {
                    if (select.options[i].selected) {
                        count++;
                    }
                }
                if(count == 0){
                    $('#selectRoles').html('');
                }
                $.each($("#industry_id option:selected"), function(){
                    industries.push($(this).val());
                    $.ajax({
                        url: '{{ route("api.roles.index") }}',
                        type: 'get',
                        data: { _token: '{{ csrf_token() }}', 'industries':industries},
                        success: function(data){
                            if (data.length > 0) {
                                $('#roles_div').show();
                                let i; let html='';
                                for (i = 0; i < data.length; i++) {
                                    if (lang == 'ar') {
                                        html+= '<option value ="'+data[i].id+'">'+data[i].translations[0].name+'</option>';
                                    } else {
                                        html+= '<option value ="'+data[i].id+'">'+data[i].translations[1].name+'</option>';
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
                        error: function(){
                            alert("error");
                        }
                    });
                });
            });
        });

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
