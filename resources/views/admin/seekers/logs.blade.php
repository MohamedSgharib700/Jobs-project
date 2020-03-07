@extends('admin.layout')

@section('content')
    <div class="app-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ trans('seeker_details') }}</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills pb-3" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link " id="home-tab3" href="{{ route('admin.seekers.edit', ['seeker' => $seeker]) }}">{{ trans('personal_data') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="dec-tab3" @if($seeker->details) href="{{ route('admin.seeker.details.edit', ['seeker' => $seeker, 'details' => $seeker->details]) }}" @else href="{{ route('admin.seeker.details.create', ['seeker' => $seeker]) }}" @endif role="tab" >{{ trans('job_details') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="dec-tab4" @if($seeker->experiences) href="{{ route('admin.seeker.experiences.edit', ['seeker' => $seeker, 'experiences' => $seeker->experiences]) }}" @else href="{{ route('admin.seeker.experiences.create', ['seeker' => $seeker]) }}"  @endif role="tab" aria-controls="contact" aria-selected="false">{{ trans('experiences_and_skills') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dec-tab5" href="#" >{{ trans('logs') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content border-top p-3">
                                    <div class="tab-pane fade show active p-0" id="doc5" role="tabpanel" aria-labelledby="dec-tab5">
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12 mx-auto">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>{{ trans('logs') }}</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="example-2" class="table table-striped table-bordered border-t0 text-nowrap w-100">
                                                                <thead>
                                                                <tr>
                                                                    <th class="wd-15p">{{ trans('edit_date') }}</th>
                                                                    <th class="wd-15p">{{ trans('user_name') }}</th>
                                                                    <th class="wd-15p"> {{ trans('the_update') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($list as $log)
                                                                    <tr>
                                                                        <td>{{ $log->created_at }}</td>
                                                                        <td>{{ $log->user ? $log->user->name : '-' }}</td>
                                                                        <td>{{ $log->message }}</td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
