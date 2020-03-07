@extends('admin.layout')

@section('content')
    <?php
    use \App\Constants\AgeRange;
    ?>
    <div class="app-content">
        <section class="section">
            <div class="page-header">
                <h4 class="page-title">{{ trans('seekers') }}</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-light-color">{{ trans('home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('seekers') }}</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{trans('filter_by')}}</h4>
                        </div>
                        <div class="card-body ">
                            <form action="{{ route("admin.seekers.index") }}" method="get">
                                <div class="row">
                                    <div class="form-group col-lg-3 col-md-6">
                                        <div class="search-element">
                                            <input class="form-control" name="name" id="name"
                                                   value="{{ request('name') }}" placeholder="{{ trans('name') }}"
                                                   aria-label="{{ trans('search') }}" type="search">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6">

                                        <select multiple="multiple" class="multi-select" name="industries[]"
                                                id="industry">
                                            <option selected disabled value=""  class="test">{{ trans('industries') }}</option>
                                            @foreach($industries as $industry)
                                                <option
                                                    value="{{ $industry->id }}" @if (request('industries')) {{ in_array($industry->id, request('industries')) ? "selected" : "" }} @endif>{{ $industry->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6">
                                        <select class="form-control" name="cv" id="cv">
                                            <option selected disabled value="">{{ trans('cv_status') }}</option>
                                            <option
                                                value="1" {{request('cv') === "1" ?'selected':''}}>{{ trans('available') }}</option>
                                            <option
                                                value="0" {{request('cv') === "0" ?'selected':''}}>{{ trans('not_available') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6">
                                        <select class="form-control" name="active" id="active">
                                            <option selected  value="">{{ trans('select_status') }}</option>
                                            <option
                                                value="1" {{request('active') === "1" ?'selected':''}}>{{ trans('active') }}</option>
                                            <option
                                                value="0" {{request('active') === "0" ?'selected':''}}>{{ trans('disabled') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3 col-md-6">
                                        <select multiple="multiple" class="multi-select" name="countries[]" id="countries">
                                            <option selected disabled value="">{{(!request('countries'))? trans('select_country'):'' }}</option>
                                            @foreach($countries as $country)
                                                <option
                                                    value="{{ $country->id }}" @if (request('countries')) {{ in_array($country->id, request('countries')) ? "selected" : "" }} @endif>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6">
                                        <select class="form-control" name="gender" id="gender">
                                            <option selected disabled value="">{{ trans('gender') }}</option>
                                            <option
                                                value="0" {{request('gender') === "0" ?'selected':''}}>{{ trans('male') }}</option>
                                            <option
                                                value="1" {{request('gender') === "1" ?'selected':''}}>{{ trans('female') }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6">
                                        <select multiple="multiple" class="multi-select" name="age[]" id="age">
                                            <option selected disabled value="">{{ trans('age') }}</option>
                                            @foreach(AgeRange::getList() as $key => $value)
                                                <option
                                                    value="{{ $key }}" @if (request('age')) {{ in_array($key, request('age')) ? "selected" : "" }} @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row">
                                          <div class="form-group col-lg-3 col-md-6 ">
                                        <div class="form-group ">
                                                <label class="float-left">{{ trans('from_date') }}</label>

                                            <div class="input-group">
                                                  <input type="date" class="form-control" name="from_date" id="from_date"
                                                       value="{{ request('from_date') }}"
                                                       placeholder="{{ trans('from_date') }}">
                                                
                                              
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 ">
                                        <div class="form-group ">
                                                <label class="float-left">{{ trans('to_date') }}</label>

                                            <div class="input-group">

                                                <input type="date" class="form-control" name="to_date" id="to_date"
                                                       value="{{ request('to_date') }}"
                                                       placeholder="{{ trans('to_date') }}">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    </div>
                                  
                                
                                <div class="row">
                                    <div class="form-group col-lg-2 col-md-6 mt-3">
                                        <span class="table-add ">
                                            <button type="submit" class="btn btn-add btn-block"> {{ trans('search') }} </button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="table-add mt-3 mr-3">
                                        @can("seekersCreate", User::class)
                                            <a href="{{ route('admin.seekers.create') }}"
                                               class="btn btn-add btn-block"> {{ trans('new_seeker') }} </a>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-5">
                                    <form>
                                        <div class="table-add mt-3">
                                            <a href="{{ route('admin.seekers.import') }}"
                                               class="btn btn-add btn-block"> {{ trans('import_seekers') }} </a>
                                        </div>
                                    </form>
                                </div>
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
                                <div class="table-responsive">
                                    <table id="example-2"
                                           class="table table-striped table-bordered border-t0 text-nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th class="wd-15p">{{ trans('id') }}</th>
                                            <th class="wd-15p">{{ trans('name') }}</th>
                                            <th class="wd-15p"> {{ trans('date') }}</th>
                                            <th class="wd-15p">{{ trans('email') }}</th>
                                            <th class="wd-20p">{{ trans('country') }}</th>
                                            <th class="wd-20p">{{ trans('age') }}</th>
                                            <th class="wd-15p">{{ trans('cv') }}</th>
                                            <th class="wd-15p">{{ trans('gender') }}</th>
                                            <th class="wd-15p">{{ trans('phone') }}</th>
                                            <th class="wd-15p"> {{ trans('status') }}</th>
                                            @if(auth()->user()->hasAccess("admin.seekers.update") || auth()->user()->hasAccess("admin.seekers.destroy"))
                                                <th class="wd-15p">{{ trans('actions') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($list as $seeker)
                                            <tr>
                                                <td>{{ $seeker->id }}</td>
                                                <td>
                                                    <a href="{{ route('admin.seekers.edit', ['seeker' => $seeker->id]) }}">{{ $seeker->first_name." ".$seeker->last_name }}</a>
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($seeker->created_at)->format('m/d/Y')}}</td>
                                                <td>{{ $seeker->email }}</td>
                                                <td>{{ $seeker->nationality ? $seeker->nationality->name: "-" }}</td>
                                                <td>{{ AgeRange::getOne($seeker->age) }}</td>
                                                <td> @if (isset($seeker->details) && $seeker->details->cv != "" )  <a
                                                        href="{{ asset($seeker->details->cv) }}">{{ trans('download_cv') }}</a> @else {{ trans('not_found') }} @endif
                                                </td>
                                                <td> @if ($seeker->gender == 1) {{trans('female')}} @elseif ($seeker->gender === 0) {{ trans('male')  }} @else
                                                        -  @endif</td>
                                                <td> {{ $seeker->phone }}</td>
                                                <td>
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="active" id="active"
                                                               data-model="{{  get_class($seeker) }}"
                                                               data-id="{{ $seeker->id }}" value="{{ $seeker->active }}"
                                                               {{ $seeker->active ? 'checked' : '' }} class="custom-switch-input">
                                                        <span class="custom-switch-indicator publish"></span>
                                                    </label>
                                                </td>
                                                @if(auth()->user()->hasAccess("admin.seekers.update") || auth()->user()->hasAccess("admin.seekers.destroy"))
                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <button type="button"
                                                                    class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <i class="fa-cog fa"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can("seekersUpdate", $seeker)
                                                                    <a class="dropdown-item has-icon"
                                                                       href="{{ route('admin.seekers.edit', ['seeker' => $seeker->id]) }}"><i
                                                                            class="fa fa-edit"></i> {{trans('edit')}}
                                                                    </a>
                                                                @endcan
                                                                @can("seekersDelete", $seeker)
                                                                    <button type="button" class="dropdown-item has-icon"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModalLong{{ $seeker->id }}">
                                                                        <i class="fa fa-trash"></i> {{trans('remove')}}
                                                                    </button>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{ $list->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @foreach ($list as $seeker)
            <div class="modal fade" id="exampleModalLong{{ $seeker->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{trans('delete')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.seekers.destroy', ['seeker' => $seeker]) }}" method="Post">
                            @method('DELETE')
                            @csrf
                            <div class="modal-body">
                                <p class="mb-0">{{trans('delete_confirmation_message')}}</p>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"> {{trans('delete')}}</button>

                                <button type="button" class="btn btn-success"
                                        data-dismiss="modal">{{trans('close')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
 <script>
$(document).ready(function () {
$('.multi-select').on('change', function() {
// $(".test").removeAttr('checked');

});

        });


    </script>
