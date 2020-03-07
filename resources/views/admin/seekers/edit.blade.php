@extends('admin.layout')

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
                        <h4 class="page-title">{{ trans('seeker_details') }}  </h4>
                        <a href="" class="btn btn-danger mt-1 mr-auto" data-toggle="modal" data-target="#exampleModalLong{{$seeker->id}}"  >{{ trans('remove') }}</a>
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4> {{ trans('seeker_details') }}</h4>
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
                                        <a class="nav-link active"  href="{{ route('admin.seekers.edit', ['seeker' => $seeker]) }}" >{{ trans('personal_data') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        @if ($seekerDetails)
                                            <a class="nav-link" href="{{ route('admin.seeker.details.edit', ['seeker' => $seeker, 'details' => $seekerDetails]) }}" >{{ trans('job_details') }}</a>
                                        @else
                                            <a class="nav-link" href="{{ route('admin.seeker.details.create', ['seeker' => $seeker]) }}" >{{ trans('job_details') }} </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if (!$seekerDetails)
                                            <a class="nav-link" href="#" >{{ trans('experiences_and_skills') }}</a>
                                        @elseif ($seekerDetails && !$seekerExperiences)
                                            <a class="nav-link" href="{{ route('admin.seeker.experiences.create', ['seeker' => $seeker]) }}" >{{ trans('experiences_and_skills') }}</a>
                                        @elseif ($seekerDetails && $seekerExperiences)
                                            <a class="nav-link" href="{{ route('admin.seeker.experiences.edit', ['seeker' => $seeker, 'experiences' => $seekerExperiences]) }}" >{{ trans('experiences_and_skills') }}</a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.seeker.logs', ['user' => $seeker]) }}" >{{ trans('logs') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content border-top p-3">
                                    <div class="tab-pane fade show active p-0" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                        <div class="row">
                                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 mx-auto " >
                                                <div class="card" >
                                                    <form action="{{ route('admin.seekers.update', ['seeker' => $seeker]) }}" method="post">
                                                        @csrf
                                                        @method("Put")
                                                        <input type="hidden" name="id" value="{{ $seeker->id}}" />
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
                                                                            <label for="first_name">{{ trans('first_name') }}</label>
                                                                             <fieldset>
                                                                            <input type="text"  class="form-control disabled" name="first_name"  id="first_name" value="{{old('first_name', $seeker->first_name)}}" placeholder="{{ trans('first_name') }} ">
                                                                            </fieldset>
                                                                            @if ($errors->has('first_name'))
                                                                                <div class="error">
                                                                                    <strong style="color:red;">{{ $errors->first('first_name') }}</strong>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <fieldset>
                                                                        <div class="form-group">
                                                                            <label for="last_name" >{{ trans('last_name') }}</label>
                                                                            <input type="text" class="form-control disabled"   name="last_name"  id="last_name" value="{{old('last_name', $seeker->last_name)}}" placeholder="{{ trans('last_name') }}">
                                                                            @if ($errors->has('last_name'))
                                                                                <div class="error">
                                                                                    <strong style="color:red;">{{ $errors->first('last_name') }}</strong>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <fieldset>
                                                                            <label for="country_key">{{ trans('country_key') }}</label>
                                                                            <select name="country_key" id="country_key" class="select2 col-md-12 disabled" >
                                                                                <option value="">{{ trans('select_country_key') }}</option>
                                                                                @foreach($countries as $country)
                                                                                    <option value="{{ $country->id }}" {{ old("country_key", $seeker->country_key) == $country->id ? "selected":null }}>{{ $country->name." ".$country->code }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                    <div class="form-group">
                                                                        <fieldset>
                                                                            <label for="phone">{{ trans('phone') }}</label>
                                                                            <input type="number" class="form-control disabled"  name="phone" id="phone" value="{{ old('phone', $seeker->phone) }}" placeholder="{{trans('phone')}}"/>
                                                                            @if ($errors->has('phone'))
                                                                                <div class="error">
                                                                                    <strong style="color:red;">{{ $errors->first('phone') }}</strong>
                                                                                </div>
                                                                            @endif
                                                                        </fieldset>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-12">
                                                                     <fieldset>
                                                                    <label for="email">{{ trans('email') }}</label>
                                                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $seeker->email) }}" placeholder="{{ trans('email') }}">
                                                                    @if ($errors->has('email'))
                                                                        <div class="error">
                                                                            <strong style="color:red;">{{ $errors->first('email') }}</strong>
                                                                        </div>
                                                                    @endif
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-lg-6 col-md-12">
                                                                      <fieldset>
                                                                    <label for="password">{{ trans('password') }}</label>
                                                                    <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="{{ trans('password') }}">
                                                                    @if ($errors->has('password'))
                                                                        <div class="error">
                                                                            <strong style="color:red;">{{ $errors->first('password') }}</strong>
                                                                        </div>
                                                                    @endif
                                                                       </fieldset>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nationality_id">{{ trans('nationality') }}</label>
                                                                <select name="nationality_id" id="nationality_id" class="select2 col-md-12">
                                                                    <option value="">{{ trans('select_nationality_id') }}</option>
                                                                    @foreach($countries as $country)
                                                                        <option value="{{ $country->id }}" {{ old("nationality_id",$seeker->nationality_id) == $country->id ? "selected":null }}>{{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="age">{{ trans('age') }}</label>
                                                                <select name="age" id="age" class="select2 col-md-12">
                                                                    <option selected value="">{{ trans('select_age_range') }}</option>
                                                                    @foreach(AgeRange::getList() as $key => $value)
                                                                        <option value="{{ $key }}" {{ old("age",$seeker->age) == $key ? "selected":null }}>{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="gender">{{ trans('gender') }}</label>
                                                                <select class="select2 col-md-12" name="gender" id="gender">
                                                                    <option  value="" >{{ trans('select_gender') }}</option>
                                                                    <option value="0" {{ $seeker->gender =='0' ? 'selected':null }}>{{ trans('male') }}</option>
                                                                    <option value="1" {{ $seeker->gender == 1 ? 'selected':null }}>{{ trans('female') }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="marital_status">{{ trans('marital_status') }}</label>
                                                                <select class="select2 col-md-12" name="marital_status" id="marital_status">
                                                                    <option selected value="">{{ trans('select_marital_status') }}</option>
                                                                    @foreach(MaritalStatus::getList() as $key => $value)
                                                                        <option value="{{ $key }}" @if($seeker->details) {{ old("marital_status", $seeker->details->marital_status) == $key ? "selected":null }} @endif>{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="military_status">{{ trans('military_status') }}</label>
                                                                <select class="select2 col-md-12" name="military_status" id="military_status">
                                                                    <option selected value="">{{ trans('select_military_status') }}</option>
                                                                    @foreach(MilitaryStatus::getList() as $key => $value)
                                                                        <option value="{{ $key }}" @if($seeker->details)  {{ old("military_status", $seeker->details->military_status) == $key ? "selected":null }} @endif>{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <input type="submit" class="btn btn-primary mt-1" value="{{ trans('next') }}">
                                                            <a href="#" class="btn btn-primary mt-1" onClick = "openSolution();">{{ trans('edit') }}</a>
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
@endsection
@section('scripts')

<script>
   $( "#editing" ).click(function() {
        $(".disabled").prop('disabled', false);
   });
</script>
@endsection
