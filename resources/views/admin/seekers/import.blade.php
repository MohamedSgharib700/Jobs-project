@extends('admin.layout')

@section('content')
    <div class="app-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ trans('import_seekers') }}</h4>
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
                                    @if(session()->has('danger'))
                                        <div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                                            <div class="alert-icon"><i class="ion ion-ios-lightbulb-outline"></i></div>
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>×</span>
                                                </button>
                                                <div class="alert-title">{{trans('danger')}}</div>
                                                {{ session('danger') }}
                                            </div>
                                        </div>
                                    @endif
                                <div class="row">
                                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 mx-auto " >
                                        <div class="card" >
                                            <form action="{{ route('admin.seekers.store.import') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="cv">{{ trans('example_for_seekers_click') }} </label>
                                                        <a href="{{ url('assets/uploads/Examples/Seekers.ods') }}"> {{ trans('here') }} </a>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group ">
                                                                <label for="select_file">{{ trans('select_file') }}</label>
                                                                <input type="file" class="form-control" name="select_file"  id="select_file" value="{{old('select_file')}}" placeholder="{{ trans('select_file') }} ">
                                                                @if ($errors->has('select_file'))
                                                                    <div class="alert alert-danger">
                                                                        <strong>{{ $errors->first('select_file') }}</strong>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <input type="submit" class="btn btn-primary mt-1" value="{{ trans('import') }}">
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
        </section>
    </div>
@stop
