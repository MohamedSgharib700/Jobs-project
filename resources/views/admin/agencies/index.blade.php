@extends('admin.layout')

@section('content')
    <div class="app-content">
        <section class="section">

            <!--page-header open-->
            <div class="page-header">
                <h4 class="page-title">{{ trans('agencies') }}</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-light-color">{{ trans('home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('agencies') }}</li>
                </ol>
            </div>
            <!--page-header closed-->
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{trans('filter_by')}}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="get" action="{{ route("admin.agencies.index") }}">
                                <div class="form-group row">

                                    <div class="form-group col-lg-3 col-md-6">
                                        <input type="text" placeholder="{{ trans('name') }}" class="form-control"
                                               value="{{ request("name") }}" name="name">
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

                                    <div class="form-group col-lg-3 col-md-6" id="country_id">
                                        <select name="country_id[]" multiple="multiple" class="multi-select">
                                            <option selected disabled value="">{{ trans('select_country') }}</option>
                                            @foreach($countries as $country)
                                                <option
                                                    value="{{$country->id}}" @if (request('country_id')) {{ (in_array($country->id, request('country_id'))) ? "selected" : "" }} @endif>{{$country->name}}</option>
                                            @endforeach
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
                                    <div class="form-group col-lg-2 col-md-6 col-12 mt-2">
                                        <span class="table-add ">
                                <button type="submit" class="btn btn-primary mt-1 mb-0">{{ trans("search") }}</button>
                                              </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--row closed-->
            <div class="section-body">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="col-lg-2 col-md-6 mt-3 col-8 mr-3">
                                <span class="table-add ">
                                     @can('create', Agency::class)
                                        <a href="{{ route("admin.agencies.create") }}"
                                           class="btn btn-add btn-block ">{{trans('add_agency')}}</a>
                                    @endcan
                                </span>
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
                                    <table class="table table-bordered table-hover mb-0 text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 1px">#</th>
                                            <th>{{ trans('name') }}</th>
                                            <th>{{ trans('phone') }}</th>
                                            <th>{{ trans('email') }}</th>
                                            <th>{{ trans('address') }}</th>
                                            <th>{{ trans('country') }}</th>
                                            <th>{{ trans('city') }}</th>
                                            <th style="width: 1px">{{ trans('active') }}</th>
                                            @if(auth()->user()->hasAccess("admin.agencies.update") || auth()->user()->hasAccess("admin.agencies.destroy"))
                                                <th style="width: 1px">{{ trans('actions') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($list as $agency)
                                            <tr>
                                                <td>{{ $agency->id }}</td>
                                                <td> {{ $agency->name}} </td>
                                                <td>{{ $agency->phone }}</td>
                                                <td>{{ $agency->email }}</td>
                                                <td>{{ $agency->address }}</td>
                                                <td>{{ !empty($agency->location->parent)? $agency->location->parent->name: '--'}}</td>
                                                <td>{{ $agency->location ? $agency->location->name: '--'}}</td>
                                                <td>
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="active" id="active"
                                                               data-model="{{get_class($agency)}}"
                                                               data-id="{{ $agency->id }}" value="{{ $agency->active }}"
                                                               {{ $agency->active ? 'checked' : '' }} class="custom-switch-input">
                                                        <span class="custom-switch-indicator publish"></span>
                                                    </label>
                                                </td>
                                                @if(auth()->user()->hasAccess("admin.agencies.update") || auth()->user()->hasAccess("admin.agencies.destroy"))
                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <button type="button"
                                                                    class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <i class="fa-cog fa"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('update', $agency)
                                                                    <a class="dropdown-item has-icon"
                                                                       href="{{ route('admin.agencies.edit', ['agency' => $agency]) }}"><i
                                                                            class="fa fa-edit"></i> {{ trans('edit') }}
                                                                    </a>
                                                                @endcan
                                                                @can('delete', $agency)
                                                                    <button type="button" class="dropdown-item has-icon"
                                                                            data-toggle="modal"
                                                                            data-target="#delete_model_{{ $agency->id }}">
                                                                        <i class="fa fa-trash"></i> {{ trans('remove') }}
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

    @foreach ($list as $agency)
        <!-- Message Modal -->
            <div class="modal fade" id="delete_model_{{ $agency->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{{trans('delete')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.agencies.destroy', ['agency' => $agency]) }}" method="Post">
                            @method('DELETE')
                            @csrf
                            <div class="modal-body">

                                {{trans('delete_confirmation_message')}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success"
                                        data-dismiss="modal">{{trans('close')}}</button>
                                <button type="submit" class="btn btn-primary">{{trans('delete')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Message Modal closed -->
        @endforeach

    </div>
@stop
