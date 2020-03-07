@extends('admin.layout')

@section('content')
<?php
use App\Models\Location ;
?>
    <div class="app-content">
        <section class="section">
            <!--page-header open-->
            <div class="row">
                <div class="col-6">
                    <div class="page-header">
                        <h4 class="page-title"> </h4>

                    </div>
                </div>

            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4> {{trans('edit_agency')}}</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST"action="{{ route('admin.agencies.update', ['agency' => $agency]) }}" method="post" id="horizontal-validation" class="form-horizontal" >
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label">{{trans('name')}}</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control " name="name" value="{{$agency->name}}" id="name" >
                                            @if ($errors->has('name'))
                                                <span class="text-danger">
                                                    {{$errors->first('name')}}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone" class="col-md-3 col-form-label">{{trans('phone')}}</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="phone" value="{{$agency->phone}}" id="phone" >
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">
                                                    {{$errors->first('phone')}}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-3 col-form-label">{{trans('email')}}</label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" name="email" value="{{$agency->email}}" id="email" >
                                            @if ($errors->has('email'))
                                                <span class="text-danger">
                                                    {{$errors->first('email')}}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row" id="country">
                                        <div class="col-md-3">
                                            <label for="parent">{{trans('country')}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="parent" id="parent" class="form-control select2 w-100"z>
                                                <option value="">{{ trans('select_country') }}</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}" {{$country->id  == old('parent', $agency->location->parent->id) ? "selected" : null }} >{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('parent'))
                                            <span class="text-danger">
                                                {{$errors->first('parent')}}
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row" id="city">
                                        <div class="col-md-3">
                                            <label for="location_id">{{trans('city')}}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select name="location_id" id="location_id" class="form-control select2 w-100">
                                                <option value="">Select City</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}" {{ $city->id == old('location_id', $agency->location_id) ? "selected" : null }}>{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('location_id'))
                                            <span class="text-danger">
                                                {{$errors->first('location_id')}}
                                            </span>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address" class="col-md-3 col-form-label"> {{trans('address')}}</label>
                                        <span class="col-md-9">
                                            <input type="text" class="form-control" name="address" readonly value="{{$agency->address}}" id ="address" class="form-control1" >
                                            <span class="text-danger">
                                                @if ($errors->has('address'))
                                                {{$errors->first('address')}}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 row">
                                        <input type="hidden" class="form-control" name="long" value="{{$agency->long}}" id="long" >
                                        <input type="hidden" class="form-control" name="lat" value="{{$agency->long}}" id="lat" >
                                        <input id="pac-input" style="width:350px;height:25px;margin-top:20px;"  class="controls" type="text" placeholder="{{trans('search')}}">
                                        <div class="form-group col-md-10  mx-auto" id="map" style="height: 400px; width: 100%"></div>
                                    </div>

                                    <div class="form-group mt-2 row justify-content-end text-left pl-4">
                                        <div class="col-md-9 float-left">
                                            <button type="submit" class="btn btn-edit">{{trans('save')}}</button>
                                            <button type="reset" class="btn btn-danger">{{trans('reset')}}</button>
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
