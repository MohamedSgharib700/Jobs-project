@extends('admin.layout')

@section('content')
    <div class="app-content">
        <section class="section">

            <div class="page-header">
                <h4 class="page-title">{{ trans('employers') }}</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-light-color">{{ trans('home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('employers') }}</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{trans('filter_by')}}</h4>
                        </div>
                        <div class="card-body ">
                            <form class="form-horizontal" type="get" action="{{ route("admin.employers.index") }}">
                                <div class="row">
                                    <div class="form-group col-lg-3 col-md-6">
                                        <div class="search-element">
                                            <input class="form-control" placeholder="{{ trans('name') }}"
                                                   value="{{ request("name") }}" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6">
                                        <select multiple="multiple" class="multi-select" name="location_id[]">
                                            <option  disabled selected value="">{{(!request('location_id'))? trans('select_country'):'' }}</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}" @if (request('location_id')) {{ in_array($location->id, request('location_id')) ? "selected" : "" }} @endif >{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3 col-md-6">
                                        <select name="active" class="form-control">
                                            <option value="">{{trans('select_status')}}</option>
                                            <option
                                                value="0" {{request('active') === "0" ?'selected':''}}>{{trans('disabled')}}</option>
                                            <option
                                                value="1" {{request('active') === "1" ?'selected':''}}>{{trans('active')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 ">
                                        <div class="form-group ">
                                            <div class="input-group">

                                                <input type="date" class="form-control" value="{{ request("date") }}"
                                                       name="date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-2 col-md-6 mt-2">
                                        <span class="table-add ">
                                            <button type="submit"
                                                    class="btn btn-add btn-block"> {{ trans('search') }} </button>
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
                                <div class="col-lg-2 col-md-6 mt-3 mr-4 col-6">
                                    <span class="table-add ">
                                        @can('employersCreate', User::class)
                                            <a href="{{ route('admin.employers.create') }}"
                                               class="btn btn-add btn-block">{{trans('new_employer')}}
                                            </a>
                                        @endcan
                                    </span>
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
                                            <th class="wd-15p">{{ trans('email') }}</th>
                                            <th class="wd-20p">{{ trans('phone') }}</th>
                                            <th class="wd-20p">{{ trans('company_name') }} </th>
                                            <th class="wd-15p">{{ trans('country_name') }} </th>
                                            <th class="wd-20p">{{ trans('date') }} </th>
                                            <th class="wd-20p">{{ trans('status') }}</th>
                                            @if(auth()->user()->hasAccess("admin.employers.update") || auth()->user()->hasAccess("admin.employers.destroy"))
                                                <th class="wd-20p"> {{trans('actions')}}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($list as $employer)
                                            <tr>
                                                <td>{{ $employer->id }}</td>
                                                <td>
                                                    <a href="{{ route('admin.employers.edit', ['employer' => $employer->id]) }}">

                                                        {{ $employer->first_name }} {{ $employer->last_name }}
                                                    </a>
                                                </td>
                                                <td>{{ $employer->email }}</td>
                                                <td>{{ $employer->phone }}</td>
                                                <td>{{ @$employer->employerDetails->company_name }}</td>
                                                <td>{{ @$employer->employerDetails->location->name }}</td>
                                                <td>{{ $employer->created_at }}</td>
                                                <td>
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="active" id="active"
                                                               data-model="{{  get_class($employer) }}"
                                                               data-id="{{ $employer->id }}"
                                                               value="{{ $employer->active }}"
                                                               {{ $employer->active ? 'checked' : '' }} class="custom-switch-input">
                                                        <span class="custom-switch-indicator publish"></span>
                                                    </label>
                                                </td>
                                                @if(auth()->user()->hasAccess("admin.employers.update") || auth()->user()->hasAccess("admin.employers.destroy"))
                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <button type="button"
                                                                    class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <i class="fa-cog fa"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can("employersUpdate", $employer)
                                                                    <a class="dropdown-item has-icon"
                                                                       href="{{ route('admin.employers.edit', ['employer' => $employer->id]) }}"><i
                                                                            class="fa fa-edit"></i> {{trans('edit')}}
                                                                    </a>
                                                                @endcan
                                                                @can('employersDelete', $employer)
                                                                    <button type="button" class="dropdown-item has-icon"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModalLong{{ $employer->id }}">
                                                                        <i class="fa fa-trash"></i> {{trans('remove')}}
                                                                    </button>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endcan
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{ $list->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @foreach ($list as $employer)
            <div class="modal fade" id="exampleModalLong{{ $employer->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{trans('delete')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.employers.destroy', ['employer' => $employer]) }}" method="Post">
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
