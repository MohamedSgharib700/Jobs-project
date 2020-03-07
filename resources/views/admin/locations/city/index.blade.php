@extends('admin.layout')

@section('content')
    <div class="app-content">
        <section class="section">

            <!--page-header open-->
            <div class="page-header">
                <h4 class="page-title">{{ trans('cities') }}</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-light-color">{{ trans('home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('cities') }}</li>
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
                            <form class="form-horizontal" type="get" action="{{ route("admin.locations.show",['location'=>request()->location->id]) }}">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <input type="text" name="name"  placeholder="{{ trans('name') }}" class="form-control" value="{{ request("name") }}" >
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-1 mb-0">{{ trans("search") }}</button>
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
                            <div class="col-md-2 col-6 mt-3">
                                <span class="table-add ">
                                <a href="{{ route("admin.cities.create") }}?location={{request()->location->id}}" class="btn btn-add btn-block ">{{trans('add_city')}}</a>
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
                                                <th>{{ trans('en_name') }}</th>
                                                <th>{{ trans('ar_name') }}</th>
                                                <th style="width: 1px">{{ trans('active') }}</th>
                                                @if(auth()->user()->hasAccess("admin.locations.update") || auth()->user()->hasAccess("admin.locations.destroy"))
                                                   <th style="width: 1px">{{ trans('actions') }}</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cities as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->translate('en')->name }}</td>
                                                    <td>{{ $item->translate('ar')->name }}</td>
                                                    <td>
                                                        <label class="custom-switch">
                                                            <input type="checkbox" name="active" id="active" data-model="{{get_class($item)}}" data-id="{{ $item->id }}" value="{{ $item->active }}" {{ $item->active ? 'checked' : '' }} class="custom-switch-input">
                                                            <span class="custom-switch-indicator publish"></span>
                                                        </label>                                                    
                                                    </td>
                                                    @if(auth()->user()->hasAccess("admin.locations.update") || auth()->user()->hasAccess("admin.locations.destroy"))
                                                        <td>
                                                            <div class="btn-group dropdown">
                                                                <button type="button" class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa-cog fa"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    @can('update', $item)
                                                                        <a class="dropdown-item has-icon" href="{{ route('admin.cities.edit', ['city' => $item]) }}"><i class="fa fa-edit"></i> {{ trans('edit') }}</a>
                                                                    @endcan
                                                                    @can('delete', $item)
                                                                        <button type="button" class="dropdown-item has-icon" data-toggle="modal" data-target="#delete_model_{{ $item->id }}">
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
                                    {{ $cities->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @foreach ($cities as $item)
            <!-- Message Modal -->
            <div class="modal fade" id="delete_model_{{ $item->id }}" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{{trans('delete')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="{{ route('admin.cities.destroy', ['city' => $item]) }}" method="Post" >
                            @method('DELETE')
                            @csrf
                            <div class="modal-body">

                            {{trans('delete_confirmation_message')}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">{{trans('close')}}</button>
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
