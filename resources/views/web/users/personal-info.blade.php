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
                <div class="col-md-4 col-6">
                    <div class="stepper-number">
                        <span>1</span>
                        <h2>{{ trans('personal_info') }}</h2>
                    </div>
                    <div class="stepper-span d-none d-sm-block "></div>
                </div>
                <div class="col-md-2 col-3">
                    <div class="stepper-number2">
                        <span>2</span>
                    </div>
                    <div class="stepper-span d-none d-sm-block "></div>
                </div>
                <div class="col-md-2 col-3">
                    <div class="stepper-number2 ">
                        <span>3</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end header -->
    <!-- start header -->
    <section class="stepper-phone d-block d-sm-none d-md-block d-lg-none ">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-4">
                    <div class="stepper-number">
                        <span>1</span>
                    </div>
                    <div class="stepper-span"></div>
                </div>
                <div class="col-md-3 col-4">
                    <div class="stepper-number2">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="personal-header">
                                <h2>{{ trans('personal_info') }}</h2>
                                <p>{{ trans('please_complete_your_data') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <form class="col-12" action="{{ route('web.seeker.store.personal.info') }}" method="post">
                        @csrf
                        <div class="row">
                        <div class="col-12">
                            <h2>{{ trans('name') }}</h2>
                            <p>{{ trans('enter_first_last_name') }}</p>
                        </div>
                        <!-- <div class="row"> -->
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{old('first_name', $seeker->first_name)}}" placeholder="{{ trans('first_name') }}">
                                @error('first_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" id="last_name"  value="{{old('last_name', $seeker->last_name)}}" placeholder="{{ trans('last_name') }}" >
                                @error('last_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        <!-- </div> -->
                        <div class="col-12">
                            <h2>{{ trans('connection') }}</h2>
                            <p>{{ trans('enter_your_phone') }}</p>
                        </div>
                        <!-- <div class="row"> -->
                            <div class="col-md-4">
                                <div class="dropdown myselect2">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <img class="flag" src="img/Icons/saudi_arabia.png" alt="">
                                        996
                                    </a>
                                    <input class="input-hidden" type="text" name="" value="">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li class="dropdown-item my-item">
                                            <img class="flag" src="img/Icons/egypt.png" alt="">
                                            <span>02</span>
                                        </li>
                                        <li class="dropdown-item my-item">
                                            <img class="flag" src="img/Icons/india.png" alt="">
                                            <span>91</span>
                                        </li>
                                        <li class="dropdown-item my-item">
                                            <img class="flag" src="img/Icons/united_arab_emirates.png" alt="">
                                            <span>971</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <a class="confirm-mob" data-toggle="modal" data-target="#exampleModalCenter4">مؤكد</a>
                                <img src="{{ asset('/assets/web/img/Icons/verified.png') }}" class="confirm-verfied" alt="">
                                <input type="number" class="form-control" name="phone" id="phone" value="{{old('phone', $seeker->phone)}}" placeholder="{{ trans('phone') }}" >
                                @error('phone')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        <!-- </div> -->
                        <div class="col-12">
                            <h2>البريد الإلكتروني</h2>
                            <p>قم بإدخال عنوان بريدك الإلكتروني</p>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" name="email" id="email" value="{{old('email', $seeker->email)}}" placeholder="{{ trans('email') }}">
                            @error('email')
                            <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <a href="#" class="confirm-email" data-toggle="modal" data-target="#exampleModalCenter2">{{ trans('press_here_to_confirm') }}
                                {{ trans('email') }}
                            </a>
                        </div>
                        <div class="col-12">
                            <h2>{{trans('nationality')}}</h2>
                            <p>{{ trans('select_your_country') }}</p>
                            <select class="myselect" name="nationality_id" id="nationality_id">
                                <option value="">{{trans('nationality')}}</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old("nationality_id", $seeker->nationality_id) == $country->id ? "selected":null }}>{{ $country->name}}</option>
                                @endforeach
                            </select>
                            @error('nationality_id')
                            <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- <div class="row"> -->
                            <div class="col-md-6">
                                <h2>{{ trans('residence_country') }}</h2>
                                <p>{{ trans('select_residence_country') }}</p>
                                <select class="myselect" name="country_key" id="country_key">
                                    <option value="">{{ trans('residence_country') }}</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old("country_key", $seeker->country_key) == $country->id ? "selected":null }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_key')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <h2>{{ trans('residence_city') }}</h2>
                                <p>{{ trans('select_residence_country') }}</p>
                                <select class="myselect" name="residence_city" id="residence_city">
                                    <option value="">{{ trans('residence_city') }}</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ old("residence_city", $seeker->residence_city) == $city->id ? "selected":null }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('residence_city')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        <!-- </div> -->
                        <!-- <div class="row"> -->
                            <div class="col-md-6">
                                <h2>{{ trans('age') }}</h2>
                                <p>{{ trans('select_your_age') }}</p>
                                <select class="myselect" name="age" id="age">
                                    <option value="">{{ trans('age') }}</option>
                                    @foreach(AgeRange::getList() as $key => $value)
                                        <option value="{{ $key }}" {{ old("age", $seeker->age) == $key ? "selected":null }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <h2>{{ trans('gender') }}</h2>
                                <p>{{ trans('select_gender') }}</p>
                                <select class="myselect" name="gender">
                                    <option value="">{{ trans('select_gender') }}</option>
                                    <option value="0" {{ old("gender", $seeker->gender) === 0 ? "selected":null }}>{{ trans('male') }}</option>
                                    <option value="1" {{ old("gender", $seeker->gender) == 1 ? "selected":null }}>{{ trans('female') }}</option>
                                </select>
                            </div>
                        <!-- </div> -->
                        <!-- <div class="row"> -->
                            <div class="col-md-6">
                                <h2>{{ trans('marital_status') }}</h2>
                                <p>{{ trans('select_marital_status') }}</p>
                                <select class="myselect" name="marital_status" id="marital_status">
                                    <option value="">{{ trans('marital_status') }}</option>
                                    @foreach(MaritalStatus::getList() as $key => $value)
                                        <option value="{{ $key }}" @if($seeker->details) {{ old("marital_status", $seeker->details->marital_status) == $key ? "selected":null }} @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <h2>{{ trans('military_status') }}</h2>
                                <p>{{ trans('select_military_status') }}</p>
                                <select class="myselect" name="military_status" id="military_status">
                                    <option value="">{{ trans('military_status') }}</option>
                                    @foreach(MilitaryStatus::getList() as $key => $value)
                                        <option value="{{ $key }}" @if($seeker->details) {{ old("military_status", $seeker->details->military_status) == $key ? "selected":null }} @endif >{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <!-- </div> -->
                        <!-- <div class="row"> -->
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn next-btn">{{ trans('next') }}</button>
                            </div>
                        </div>
                        <!-- </div> -->
                    </form>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </section>
@stop
@section('scripts')
    <script>
        $('#country_key').on('change', function() {
            $.ajax({
                url: '{{ route("api.locations") }}',
                type: 'get',
                data: { _token: '{{ csrf_token() }}','parent':this.value, 'active':1},

                success: function(data){
                    var html='<option value ="">{{ trans("residence_city") }}</option>';
                    var i;
                    for(i=0;i<data.length;i++){
                        html+= '<option value ="'+data[i].id+'">'+data[i].name+'</option>';
                    }
                    $('#residence_city').html(html);
                },
                error: function(){
                    //alert("error");
                }
            });
        });
    </script>
@endsection
