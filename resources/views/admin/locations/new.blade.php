@extends('admin.layout')

@section('content')

    <div class="app-content">
        <section class="section">
            <!--page-header open-->
            <div class="row">
                <div class="col-6">
                    <div class="page-header">
                        <h4 class="page-title"> </h4>

                    </div>
                </div>
                <!-- <div class="col-6 text-left">
                    <img src="assets/img/logo-2030000.png" alt="">
                </div> -->

            </div>
            <!--page-header closed-->

            <div class="section-body">

                <!--row open-->
                <div class="row">
                    <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                        <h4> {{trans('new_country')}}</h4>
                        </div>
                        <div class="card-body">
                        <form method="POST" action="{{route('admin.locations.store')}}" id="horizontal-validation" class="form-horizontal" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group row">
                                <label for="ar_name" class="col-md-3 col-form-label">{{trans('ar_name')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control " name="ar[name]" value="{{old('ar.name')}}" id="ar_name" >
                                    @if ($errors->has('ar.name'))
                                        <span class="text-danger">
                                            {{$errors->first('ar.name')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="en_name" class="col-md-3 col-form-label">{{trans('en_name')}}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="en[name]" value="{{old('en.name')}}" id="en_name" >
                                    @if ($errors->has('en.name'))
                                        <span class="text-danger">
                                            {{$errors->first('en.name')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="code" class="col-md-3 col-form-label">{{trans('code')}} </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" value="{{old('code')}}" name="code" id="code"  placeholder="" >
                                    @if ($errors->has('code'))
                                        <span class="text-danger">
                                            {{$errors->first('code')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-3 col-form-label"> {{trans('image')}}</label>
                                <div class="col-md-9">
                                    <div class="form-group upload-btn-wrapper1 files color  mb-lg-0">
                                    <input type="file" name="image" id ="image" class="form-control1" >
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="text-danger">
                                            {{$errors->first('image')}}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mb-0 mt-2 row justify-content-end text-left">
                                <div class="col-md-9 float-left">
                                    <input type="submit" class="btn btn-primary mt-1" value="{{ trans('save') }}">
                                    <input type="reset" class="btn btn-danger mt-1" value="{{ trans('reset') }}">
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>

            </div>

        </section>
    </div>
@endsection
