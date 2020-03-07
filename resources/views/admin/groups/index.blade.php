@extends('admin.layout')

@section('content')
    <div class="app-content">
        <section class="section">

            <!--page-header open-->
            <div class="page-header">
                <h4 class="page-title">{{ trans('groups') }}</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-light-color">{{ trans('home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('groups') }}</li>
                </ol>
            </div>
            <!--page-header closed-->
            <!--row open-->
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{trans('filter_by')}}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" type="get" action="{{ route("admin.groups.index") }}">
                                <div class="form-group row">
                                    <div class="col-lg-3 col-md-6">
                                        <input type="text" placeholder="{{ trans('name') }}" class="form-control"
                                               value="{{ request("name") }}" name="name">
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
                            <div class="col-lg-2 col-md-6 col-8 mt-3 mr-3">
                                <span class="table-add ">
                                      @can('create',Group::class)
                                        <a href="{{ route("admin.groups.create") }}"
                                           class="btn btn-add btn-block ">{{trans('new_group')}}
                                        </a>
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
                                            <div class="alert-title">{{ trans('success') }}</div>
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
                                            <th style="width: 1px">{{ trans('status') }}</th>
                                            @if(auth()->user()->hasAccess("admin.groups.update") || auth()->user()->hasAccess("admin.groups.destroy"))
                                                <th style="width: 1px">{{ trans('actions') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($list as $group)
                                            <tr>
                                                <td>{{ $group->id }}</td>
                                                <td>{{ $group->name }}</td>

                                                <td>
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="active" id="active"
                                                               data-model="{{get_class($group)}}"
                                                               data-id="{{ $group->id }}" value="{{ $group->active }}"
                                                               {{ $group->active ? 'checked' : '' }} class="custom-switch-input">
                                                        <span class="custom-switch-indicator publish"></span>
                                                    </label>
                                                </td>

                                                @if(auth()->user()->hasAccess("admin.groups.update") || auth()->user()->hasAccess("admin.groups.destroy"))
                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <button type="button"
                                                                    class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <i class="fa-cog fa"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('update', $group)
                                                                    <a class="dropdown-item has-icon"
                                                                       href="{{ route('admin.groups.edit', ['group' => $group->id]) }}">
                                                                        <i class="fa fa-edit"></i> {{ trans('edit') }}
                                                                    </a>
                                                                @endcan
                                                                @can('index',GroupPermission::class)
                                                                    <a class="dropdown-item has-icon" href="{{ route('admin.group.permissions.index', ['group' => $group]) }}">
                                                                        <i class="fa fa-edit"></i>
                                                                        {{ trans('permissions') }}
                                                                    </a>
                                                                @endcan
                                                                @can('delete', $group)
                                                                    <button type="button" class="dropdown-item has-icon"
                                                                            data-toggle="modal"
                                                                            data-target="#delete_model_{{ $group->id }}">
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

    @foreach ($list as $group)
        <!-- Message Modal -->
            <div class="modal fade" id="delete_model_{{ $group->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{{ trans('delete') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.groups.destroy', ['group' => $group]) }}" method="Post">
                            @method('DELETE')
                            @csrf
                            <div class="modal-body">
                                {{ trans('delete_confirmation_message') }}

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success"
                                        data-dismiss="modal">{{ trans('close') }}</button>
                                <button type="submit" class="btn btn-primary">{{ trans('delete') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Message Modal closed -->
        @endforeach

    </div>
@stop
