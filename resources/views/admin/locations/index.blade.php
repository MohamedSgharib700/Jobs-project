@extends('admin.layout')

@section('content')
    <div class="app-content">
        <section class="section">

            <!--page-header open-->
            <div class="page-header">
                <h4 class="page-title">{{ trans('locations') }}</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-light-color">{{ trans('home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('countries') }}</li>
                </ol>
            </div>
            <!--page-header closed-->
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{trans('filter_by')}}</h4>
                        </div>
                        <div class="card-body ">
                            <form>
                                <div class="row">
                                    <div class="form-group col-lg-3 col-md-6">

                                        <input type="name" name="name" class="form-control" id="exampleInputEmail1"
                                               placeholder="{{ trans('name') }}">
                                    </div>



                                    <div class="form-group form-check col-md-6">
                                        <label class="form-check-label"
                                               for="exampleCheck1">{{trans('active_country')}}</label>
                                        <input type="checkbox" name="desired" value="1"
                                               {{request('desired')?'checked':''}} id="exampleCheck1">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2 col-md-6">
                                        <button type="submit" class="btn btn-primary">{{ trans("search") }}</button>
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
                            <div class="col-lg-2 col-md-6 mt-3 mr-3 col-6">
                                <span class="table-add ">
                                    @can('create', Location::class)
                                        <a href="{{ route("admin.locations.create") }}"
                                           class="btn btn-add btn-block ">{{trans('add_country')}}</a>
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
                                            <th>{{ trans('code') }}</th>
                                            <th>{{ trans('image') }}</th>
                                            <th style="width: 1px">{{ trans('active') }}</th>
                                            @if(auth()->user()->hasAccess("admin.locations.update") || auth()->user()->hasAccess("admin.locations.destroy"))
                                                <th style="width: 1px">{{ trans('actions') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($list as $location)
                                            <tr>
                                                <td>{{ $location->id }}</td>
                                                <td>
                                                    <a href="{{route('admin.locations.show',['location' => $location ])}}">{{ $location->name}}</a>
                                                </td>
                                                <td>{{ $location->code }}</td>
                                                <td><img style="width:100px;height:100px;" src="{{ $location->image }}"
                                                         alt=""></td>
                                                <td>
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="active" id="active"
                                                               data-model="{{get_class($location)}}"
                                                               data-id="{{ $location->id }}"
                                                               value="{{ $location->active }}"
                                                               {{ $location->active ? 'checked' : '' }} class="custom-switch-input">
                                                        <span class="custom-switch-indicator publish"></span>
                                                    </label>
                                                </td>
                                                @if(auth()->user()->hasAccess("admin.locations.update") || auth()->user()->hasAccess("admin.locations.destroy"))
                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <button type="button"
                                                                    class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <i class="fa-cog fa"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('update', $location)
                                                                    <a class="dropdown-item has-icon"
                                                                       href="{{ route('admin.locations.edit', ['location' => $location]) }}"><i
                                                                            class="fa fa-edit"></i> {{ trans('edit') }}
                                                                    </a>
                                                                @endcan
                                                                @can('delete', $location)
                                                                    <button type="button" class="dropdown-item has-icon"
                                                                            data-toggle="modal"
                                                                            data-target="#delete_model_{{ $location->id }}">
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

    @foreach ($list as $location)
        <!-- Message Modal -->
            <div class="modal fade" id="delete_model_{{ $location->id }}" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{{trans('delete')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.locations.destroy', ['location' => $location]) }}" method="Post">
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
