@extends('admin.layout')

@section('content')
    <!--app-content open-->
    <div class="app-content">
        <section class="section">
            <!--page-header open-->
            <div class="row">
                <div class="col-6">
                    <div class="page-header">
                        <h4 class="page-title"> {{trans('users')}}</h4>

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
                                <div class="row">

                                    <div class="col-lg-2 col-md-6 col-8">
                                        @can('create', User::class)
                                            <span style="" class="table-add ">
                                                <a href="{{ route('admin.users.create') }}" class="btn btn-add btn-block">{{ trans('new_user') }}</a>
                                            </span>
                                        @endcan
                                    </div>

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
                                            <th class="wd-20p">{{ trans('date') }} </th>
                                            <th class="wd-20p">{{ trans('status') }}</th>
                                            @if(auth()->user()->hasAccess("admin.users.update") || auth()->user()->hasAccess("admin.users.delete") || auth()->user()->hasAccess("admin.users.group.index")  )
                                                <th class="wd-20p"> {{trans('actions')}}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($list as $user)

                                            <tr>
                                                <td>{{ $user->id }}</td>

                                                <td>
                                                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}">

                                                        {{ $user->first_name }}  {{ $user->last_name }}
                                                    </a>
                                                </td>

                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>

                                                <td>{{ $user->created_at }}</td>

                                                <td>
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="active" id="active"
                                                               data-model="{{  get_class($user) }}"
                                                               data-id="{{ $user->id }}"
                                                               value="{{ $user->active }}"
                                                               {{ $user->active ? 'checked' : '' }} class="custom-switch-input">
                                                        <span class="custom-switch-indicator publish"></span>
                                                    </label>
                                                </td>

                                                @if(auth()->user()->hasAccess("admin.users.update") || auth()->user()->hasAccess("admin.users.delete") || auth()->user()->hasAccess("admin.users.group.index")  )
                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <button type="button"
                                                                    class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <i class="fa-cog fa"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('update', $user)
                                                                    <a class="dropdown-item has-icon"
                                                                    href="{{ route('admin.users.edit', ['user' => $user->id]) }}">
                                                                        <i class="fa fa-edit"></i> {{trans('edit')}}
                                                                    </a>
                                                                @endcan
                                                                @can('userGroups', $user)
                                                                    <a class="dropdown-item has-icon" href="{{ route('admin.users.groups.index', ['user' => $user->id]) }}">
                                                                        <i class="fa fa-edit"></i> {{trans('groups')}}
                                                                    </a>
                                                                @endcan
                                                                @can('delete', $user)
                                                                    <button type="button" class="dropdown-item has-icon"
                                                                            data-toggle="modal"
                                                                            data-target="#exampleModalLong{{ $user->id }}">
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
                                    {{ $list->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--row closed-->
            </div>


        </section>

        <!--app-content closed-->
    @foreach ($list as $user)
        <!-- Message Modal -->
            <div class="modal fade" id="exampleModalLong{{ $user->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{trans('delete')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.users.destroy', ['user' => $user]) }}" method="Post">
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
