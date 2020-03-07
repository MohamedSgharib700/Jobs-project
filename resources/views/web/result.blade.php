
<?php
use \App\Constants\AgeRange;
use \App\Constants\YearsExperiences;
use \App\Constants\EducationLevel;
use \App\Constants\CareerLevels;
use \App\Constants\GenderTypes;
use \App\Constants\MaritalStatus;
use \App\Constants\MilitaryStatus;
?>

<div class="col-lg-3 col-md-4">
    <form>
        <div class="serch-box">
            <h3>{{trans('filter_results')}}</h3>
            <span>(32145)</span>
            <input class="btn-block" type="text" name="" value="" placeholder="{{trans('search')}}">
        </div>

        <!--  -->
        <div class="box-filtter">
            <h3>{{trans('location')}}</h3>
            <div class="box-p" id="open-1-">
                <span>{{trans('country_residence')}}</span>
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-1-content">
                @foreach($residenceCountries as $residenceCountry)
                <label>
                    <input type="checkbox" name="" value="{{$residenceCountry->id}}">
                    <span class="input-name">{{$residenceCountry->name}}</span>
                    <span class="count">{{$residenceCountry->code}}</span>
                </label>
                @endforeach
            </div>
        </div>

<!--         <div class="box-filtter">
            <div class="box-p" id="open-2-">
                <span>{{trans('city_residence')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-2-content">
              @foreach($cities as $city)
                <label>
                    <input type="checkbox" name="" value="{{$city->id}}">
                    <span class="input-name">{{$city->name}}</span>
                    <span class="count">{{$city->code}}</span>
                </label>
              @endforeach
            </div>
        </div>
 -->
        <div class="box-filtter">
            <div class="box-p" id="open-3-">
                <span>{{trans('countries_wants_work_with')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-3-content">
                @foreach($countries as $country)
                    <label>
                        <input type="checkbox" name="" value="{{$country->id}}">
                        <span class="input-name">{{$country->name}}</span>
                        <span class="count">{{$country->code}}</span>
                    </label>
                @endforeach
            </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="box-filtter">
            <h3>{{trans('job_role')}}</h3>
            <div class="box-p" id="open-4-">
                <span>{{trans('industries_titles')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-4-content">
               @foreach($industries as $industry)
                <label>
                    <input type="checkbox" name="" value="{{$industry->id}}">
                    <span class="input-name">{{$industry->name}}</span>
                    <span class="count">(98)</span>
                </label>
               @endforeach
            </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="box-filtter">
            <div class="box-p" id="open-5-">
                <span>{{trans('roles_titles')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-5-content">
                @foreach($roles as $role)
                    <label>
                        <input type="checkbox" name="" value="{{$role->id}}">
                        <span class="input-name">{{$role->name}}</span>
                        <span class="count">(98)</span>
                    </label>
                @endforeach
            </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="box-filtter">
            <h3>{{trans('experiences')}}</h3>
            <div class="box-p" id="open-6-">
                <span>{{trans('experience_years')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-6-content">
                @foreach($seekerExperience as  $value)
                <label>
                    <input type="checkbox" name="" value="{{$value->years_of_experience}}" >
                    <span class="input-name">{{ YearsExperiences::getOne($value->years_of_experience) }}</span>
                    <span class="count">(98)</span>
                </label>
                @endforeach
            </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="box-filtter">
            <div class="box-p" id="open-7-">
                <span>{{trans('experience_level')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-7-content">
                @foreach($careerLevel as $value)
                <label>
                    <input type="checkbox" name="" value="{{ $value->career_level }}">
                    <span class="input-name">{{ CareerLevels::getOne($value->career_level) }}</span>
                    <span class="count">(98)</span>
                </label>
                @endforeach

            </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="box-filtter">
            <div class="box-p" id="open-8-">
                <span>{{trans('cv')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-8-content">
                <label>
                    <input type="checkbox" name="" value="">
                    <span class="input-name">{{trans('all')}}</span>
                    <span class="count">(98)</span>
                </label>
                <label>
                    <input type="checkbox" name="" value="">
                    <span class="input-name">{{trans('he_have')}}</span>
                    <span class="count">(32)</span>
                </label>
                <label>
                    <input type="checkbox" name="" value="">
                    <span class="input-name">{{trans('he_dose_not_have')}}</span>
                    <span class="count">(32)</span>
                </label>
            </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="box-filtter">
            <h3>{{trans('personal_data')}}</h3>
            <div class="box-p" id="open-9-">
                <span>{{trans('age')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-9-content">
                @foreach($age as $value)
                <label>
                    <input type="checkbox" name="" value="{{ $value->age }}">
                    <span class="input-name">{{ AgeRange::getOne($value->age) }}</span>
                    <span class="count">(32)</span>
                </label>
                @endforeach
            </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="box-filtter">
            <div class="box-p" id="open-10-">
                <span>{{trans('type')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-10-content">
                @foreach($gender as $value)
                <label>
                    <input type="checkbox" name="" value="{{ $value->gender }}">
                    <span class="input-name">{{ GenderTypes::getOne($value->gender) }}</span>
                    <span class="count">(32)</span>
                </label>
                @endforeach
                <label>
                    <input type="checkbox" name="" value="3">
                    <span class="input-name">{{trans('all')}}</span>
                    <span class="count">(32)</span>
                </label>
            </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="box-filtter">
            <div class="box-p" id="open-11-">
                <span>{{trans('marital_status')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-11-content">
                @foreach($maritalStatus as $value)
                <label>
                    <input type="checkbox" name="" value="{{ $value->marital_status }}">
                    <span class="input-name">{{ MaritalStatus::getOne($value->marital_status) }}</span>
                    <span class="count">(98)</span>
                </label>
                @endforeach
            </div>
        </div>
        <!--  -->
        <!--  --> 
        <div class="box-filtter">
            <div class="box-p" id="open-12-">
                <span>{{trans('military_status')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-12-content">
                @foreach($militaryStatus as $value)
                <label>
                    <input type="checkbox" name="" value="{{ $value->military_status }}">
                    <span class="input-name">{{ MilitaryStatus::getOne($value->military_status) }}</span>
                    <span class="count">(98)</span>
                </label>
                @endforeach

            </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="box-filtter">
            <h3>{{trans('education')}}</h3>
            <div class="box-p" id="open-13-">
                <span>{{trans('education_level')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-13-content">
                @foreach($educationLevel as $value)
                <label>
                    <input type="checkbox" name="" value="{{$value->education_level}}">
                    <span class="input-name">{{ EducationLevel::getOne($value->education_level) }}</span>
                    <span class="count">(98)</span>
                </label>
                @endforeach

            </div>
        </div>
        <!--  -->
        <!--  -->
        <div class="box-filtter">
            <div class="box-p" id="open-14-">
                <span>{{trans('languages')}}</span>
                <img src="{{url('')}}/assets/img/Icons/minus_gray.png" alt="">
                <img class="toggle-img" src="{{url('')}}/assets/img/Icons/add_gray.png" alt="">
            </div>
            <div class="box-ch" id="open-14-content">
               @foreach($languages as $language)
                <label>
                    <input type="checkbox" name="" value="{{$language->id}}">
                    <span class="input-name">{{$language->name}}</span>
                    <span class="count">(98)</span>
                </label>
               @endforeach
            </div>
        </div>
        <!--  -->
    </form>
</div>