@extends('admin.layout')
<?php use App\Constants\CompanySize;?>
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
                    <div class="card-header">
                        <h4>{{ trans('employer_details') }}</h4>
                        <?php //print_r($employer) ;?>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills pb-3" id="myTab3" role="tablist">
                            <li class="nav-item">
                                @if ($employer)
                                <a class="nav-link" id="home-tab3"  href="{{ route('admin.employers.edit', ['employer' => $employer]) }}" role="tab" aria-controls="home" aria-selected="">{{ trans('personal_data') }}</a>
                                @else
                                <a class="nav-link" id="home-tab3"  href="{{ route('admin.employers.create') }}" role="tab" aria-controls="home" aria-selected="">{{ trans('personal_data') }}</a>
                                @endif
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="dec-tab4"  href="{{ route('admin.employer.details.create',['employer'=>$employer->id]) }}" role="tab" aria-controls="contact" aria-selected="">{{ trans('company_data') }}</a>
                            </li>
                             <li class="nav-item">
                                        <a class="nav-link"  href="{{ route('admin.employer.logs', ['employer' => $employer]) }}" >{{ trans('logs') }}</a>
                              </li>
                        </ul>


                        <form action="{{ route('admin.employer.details.store',['employer'=>$employer->id]) }}" method="post">
                            @csrf

                            <div   role="tabpanel" aria-labelledby="dec-tab4">
                                <div class="row">
                                    <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 mx-auto">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4> {{ trans('company_data') }} </h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12">

                                                       <div class="form-group ">
                                                          <label for="exampleInputname"> {{ trans('company_name') }}</label>

                                                          <input type="text" class="form-control" name="company_name"  id="company_name" value="{{old('company_name')}}" placeholder="{{ trans('company_name') }} ">
                                                          @if ($errors->has('company_name'))

                                                          <strong  style="color:red;">{{ $errors->first('company_name') }}</strong>

                                                          @endif

                                                          <input type="hidden" name="user_id" value="{{$employer->id}}">
                                                      </div>
                                                  </div>
                                                  <div class="col-lg-6 col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">{{ trans('company_industry') }}</label>

                                                        <select class="select2 col-md-12" name="industry_id">
                                                         <option value="" selected>{{ trans('select_company_industry') }}</option>
                                                         @foreach($industries as $industry)

                                                         <option value="{{ $industry->id }}" {{ (old("industry_id") == $industry->id) ? "selected":null }}>{{ $industry->name }}</option>
                                                         @endforeach
                                                     </select>
                                                     @if ($errors->has('industry_id'))
                                                      <strong  style="color:red;">{{ $errors->first('industry_id') }}</strong>
                                                    @endif
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                        <label for="exampleInputname"> {{ trans('select_company_size') }}</label>
                                        <div class="form-group">

                                            <select class="select2 col-md-12" name="company_size">
                                                <option value="" selected>{{ trans('select_company_size') }}</option>
                                                @foreach(CompanySize::getList() as $key => $value)
                                                <option value="{{ $key }}"  {{ (old("company_size") == $key) ? "selected":null }} > {{ $value }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputname"> {{ trans('job_title') }} </label>
                                        <div class="form-group">
                                          <input type="text" class="form-control" name="job_title"  id="job_title" value="{{old('job_title')}}" placeholder="{{ trans('job_title') }} ">
                                          
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="exampleInputname">{{ trans('country') }} </label>
                                    <div class="form-group">
                                        <select class="select2 col-md-12" name="location_id">
                                            <option selected value="">{{ trans('select_country') }}</option>
                                               @foreach($locations as $location)
                                                   <option value="{{ $location->id }}" {{ old("location_id") == $location->id ? "selected":null }}>{{ $location->name }}</option>
                                               @endforeach
                                        </select>
                                    </div>

                                </div>




                            </div>
                            <div class="card-footer">
                             <input type="submit" class="btn btn-primary mt-1" value="{{ trans('save') }}">
                             <input type="reset" class="btn btn-danger mt-1" value="{{ trans('reset') }}">
                         </div>
                     </div>
                 </div>

             </div>
         </form>
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
