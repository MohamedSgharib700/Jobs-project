@extends('admin.layout')

@section('content')
    <div class="app-content">
        <section class="section">
            <!--page-header open-->
            <div class="row">
                <div class="col-6">
                    <div class="page-header">
                        <h4 class="page-title">{{ trans('update_industry') }}</h4>
                    </div>
                </div>
            </div>
            <!--page-header closed-->
            <div class="section-body">
                <!--row open-->
                <div class="row">
                    <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ trans('industry_data') }}</h4>
                            </div>
                            <div class="card-body">
                                @include('admin.errors')
                                <form action="{{ route('admin.industries.update', ['industry' => $industry]) }}" method="post" enctype="multipart/form-data" id="horizontal-validation" class="form-horizontal">
                                    @method("PATCH")
                                    @csrf
                                    <div class="form-group row">
                                        <label for="ar[name]" class="col-md-3 col-form-label">{{ trans('arabic_name') }}</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="ar[name]" id="ar[name]" value="{{ $industry->translate('ar')->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="en[name]" class="col-md-3 col-form-label">{{ trans('english_name') }} </label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="en[name]" id="en[name]" value="{{ $industry->translate('en')->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="image" class="col-md-3 col-form-label"> {{ trans('image') }}</label>
                                        <div class="col-md-9">
                                            <div class="form-group upload-btn-wrapper1 files color  mb-lg-0">
                                                <input type="file" class="form-control1" name="image">
                                                <div class="img-wrap" >
                                                    <img src="{{ asset($industry->image) }}" style="width: 100%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 mt-2 row justify-content-end text-left">
                                        <div class="col-md-9 float-left">
                                            <button type="submit" class="btn btn-edit">{{ trans('save') }}</button>
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
@stop
