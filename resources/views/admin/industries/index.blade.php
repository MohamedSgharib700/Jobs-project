@extends('admin.layout')

@section('content')
    <div class="app-content">
        <section class="section">
            <!--page-header open-->
            <div class="row">
                <div class="col-6">
                    <div class="page-header">
                        <h4 class="page-title">{{trans('industries')}}</h4>
                    </div>
                </div>
            </div>
            <!--page-header closed-->
            <div class="section-body">
                <!--row open-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-lg-2 col-md-6 col-8">
                                    <span style="" class="table-add ">
                                        @can('create',Industry::class)
                                            <a href="{{ route('admin.industries.create') }}"
                                               class="btn btn-add btn-block">{{trans('add_industry')}}</a>
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
                                            <th class="wd-15p">{{ trans('arabic_name') }}</th>
                                            <th class="wd-15p">{{ trans('english_name') }}</th>
                                            <th class="wd-20p">{{ trans('image') }}</th>
                                            <th class="wd-15p">{{ trans('roles') }} </th>
                                            <th class="wd-20p">{{ trans('status') }}</th>
                                            @if(auth()->user()->hasAccess("admin.industries.update") || auth()->user()->hasAccess("admin.industries.destroy"))
                                                <th class="wd-20p"> {{trans('actions')}}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($list as $industry)
                                            <tr>
                                                <td>{{ $industry->id }}</td>
                                                <td>
                                                    <a href="{{ route('admin.industry.roles.index', ['$industry' => $industry->id]) }}">{{ $industry->translate('ar')->name }}</a>
                                                </td>
                                                <td> <a href="{{ route('admin.industry.roles.index', ['$industry' => $industry->id]) }}">{{ $industry->translate('en')->name }}</a></td>
                                                <td><img style="width: 100px" src="{{ asset($industry->image) }}"></td>
                                                <td>{{count($industry->children)}}</td>
                                                <td>
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="active" id="active"
                                                               data-model="{{  get_class($industry) }}"
                                                               data-id="{{ $industry->id }}"
                                                               value="{{ $industry->active }}"
                                                               {{ $industry->active ? 'checked' : '' }} class="custom-switch-input">
                                                        <span class="custom-switch-indicator publish"></span>
                                                    </label>
                                                </td>
                                                @if(auth()->user()->hasAccess("admin.industries.update") || auth()->user()->hasAccess("admin.industries.destroy"))
                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <button type="button"
                                                                    class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <i class="fa-cog fa"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('update', $industry)
                                                                    <a class="dropdown-item has-icon"
                                                                       href="{{ route('admin.industries.edit', ['industry' => $industry->id]) }}"><i
                                                                            class="fa fa-edit"></i> {{trans('edit')}}
                                                                    </a>
                                                                @endcan
                                                                @can('delete', $industry)
                                                                    <button type="button" class="dropdown-item has-icon"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModalLong{{ $industry->id }}">
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
                <!--row closed-->
            </div>
        </section>
    @foreach ($list as $industry)
        <!-- Message Modal -->
            <div class="modal fade" id="exampleModalLong{{ $industry->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{trans('delete')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.industries.destroy', ['industry' => $industry]) }}" method="Post">
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
            <!-- Message Modal closed -->
        @endforeach

    </div>
@stop
