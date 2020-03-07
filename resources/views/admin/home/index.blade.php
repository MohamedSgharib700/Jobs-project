@extends('admin.layout')
<?php
use \App\Constants\AgeRange;
?>
@section('content')
    <!--app-content open-->
    <div class="app-content">x
        <section class="section">
            <!--page-header open-->
            <div class="row">
                <div class="col-6">
                    <div class="page-header">
                        <h4 class="page-title">{{trans('home')}}</h4>
                    </div>
                </div>


            </div>
            <!--page-header closed-->

            <div class="section-body">


                <!--row open-->
                <div class="row">
                    <div class="col">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                          <span class="stamp stamp-md bg-primary ml-3">
                            <i class="fa fa-search"></i>
                        </span>
                                <div>
                                    <h4 class="m-0"><strong>{{$seekersCount}}</strong></h4>
                                    <h6 class="mb-0">{{trans('seekers')}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                      <span class="stamp stamp-md bg-orange ml-3">
                        <i class="fa fa-male"></i>
                    </span>
                                <div>
                                    <h4 class="m-0"><strong>{{$employersCount}}</strong></h4>
                                    <h6 class="mb-0">{{trans('employers')}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                  <span class="stamp stamp-md bg-warning ml-3">
                    <i class="fa fa-building"></i>
                </span>
                                <div>
                                    <h4 class="m-0"><strong>{{$agenciesCount}}</strong></h4>
                                    <h6 class="mb-0">{{trans('agencies')}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
              <span class="stamp stamp-md bg-success ml-3">
                <i class="fa fa-industry"></i>
            </span>
                                <div>
                                    <h4 class="m-0"><strong>{{$industriesCount}}</strong></h4>
                                    <h6 class="mb-0">{{trans('industries')}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
          <span class="stamp stamp-md bg-success ml-3">
            <i class="fa fa-map-pin"></i>
        </span>
                                <div>
                                    <h4 class="m-0"><strong>{{$locationsCount}}</strong></h4>
                                    <h6 class="mb-0">{{trans('locations')}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!--row closed-->

                <!--row open-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{trans('Last_requests_to_join')}}</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills pb-3" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3"
                                           role="tab" aria-controls="home" aria-selected="true">{{trans('seekers')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3"
                                           role="tab" aria-controls="profile"
                                           aria-selected="false">{{trans('employers')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3"
                                           role="tab" aria-controls="contact"
                                           aria-selected="false">{{trans('agencies')}}    </a>
                                    </li>

                                </ul>
                                <div class="tab-content border-top p-3">


                                    <div class="tab-pane fade show active p-0" id="home3" role="tabpanel"
                                         aria-labelledby="home-tab3">
                                        <div class="row">

                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 mx-auto ">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row">


                                                        </div>
                                                    </div>
                                                    <div class="card-body">
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
                                                                    <th class="wd-15p">{{ trans('actions') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($seekersList as $seeker)
                                                                    <tr>
                                                                        <td>{{ $seeker->id }}</td>
                                                                        <td>
                                                                            <a href="{{ route('admin.seekers.edit', ['seeker' => $seeker->id]) }}">{{ $seeker->first_name." ".$seeker->last_name }}</a>
                                                                        </td>
                                                                        <td>{{ Carbon\Carbon::parse($seeker->created_at)->format('m/d/Y')}}</td>
                                                                        <td>{{ $seeker->email }}</td>
                                                                        <td>{{ $seeker->nationality ? $seeker->nationality->name: "-" }}</td>
                                                                        <td>{{ AgeRange::getOne($seeker->age) }}</td>
                                                                        <td> @if(isset($seeker->details) && $seeker->details->cv !="" )
                                                                                <a href="{{ asset($seeker->details->cv) }}">{{ trans('download_cv') }}</a> @else {{ trans('not_found') }} @endif
                                                                        </td>
                                                                        <td>{{ $seeker->gender ? trans('female'): trans('male') }}</td>
                                                                        <td> {{ $seeker->phone }}</td>
                                                                        <td>
                                                                            <label class="custom-switch">
                                                                                <input type="checkbox" name="active"
                                                                                       id="active"
                                                                                       data-model="{{  get_class($seeker) }}"
                                                                                       data-id="{{ $seeker->id }}"
                                                                                       value="{{ $seeker->active }}"
                                                                                       {{ $seeker->active ? 'checked' : '' }} class="custom-switch-input">
                                                                                <span
                                                                                    class="custom-switch-indicator publish"></span>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <div class="btn-group dropdown">
                                                                                <button type="button"
                                                                                        class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle"
                                                                                        data-toggle="dropdown"
                                                                                        aria-haspopup="true"
                                                                                        aria-expanded="false">
                                                                                    <i class="fa-cog fa"></i>
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item has-icon"
                                                                                       href="{{ route('admin.seekers.edit', ['seeker' => $seeker->id]) }}"><i
                                                                                            class="fa fa-edit"></i> {{trans('edit')}}
                                                                                    </a>
                                                                                    <button type="button"
                                                                                            class="dropdown-item has-icon"
                                                                                            data-toggle="modal"
                                                                                            data-target="#deleteModelSeeker{{ $seeker->id }}">
                                                                                        <i class="fa fa-trash"></i> {{trans('remove')}}
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>



                                    <div class="tab-pane fade p-0" id="profile3" role="tabpanel"
                                         aria-labelledby="profile-tab3">
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 mx-auto">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row">


                                                        </div>
                                                    </div>
                                                    <div class="card-body">
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
                                                                    <th class="wd-20p"> {{trans('actions')}}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($employersList as $employer)

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
                                                                                <input type="checkbox" name="active"
                                                                                       id="active"
                                                                                       data-model="{{  get_class($employer) }}"
                                                                                       data-id="{{ $employer->id }}"
                                                                                       value="{{ $employer->active }}"
                                                                                       {{ $employer->active ? 'checked' : '' }} class="custom-switch-input">
                                                                                <span
                                                                                    class="custom-switch-indicator publish"></span>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <div class="btn-group dropdown">
                                                                                <button type="button"
                                                                                        class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle"
                                                                                        data-toggle="dropdown"
                                                                                        aria-haspopup="true"
                                                                                        aria-expanded="false">
                                                                                    <i class="fa-cog fa"></i>
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item has-icon"
                                                                                       href="{{ route('admin.employers.edit', ['employer' => $employer->id]) }}"><i
                                                                                            class="fa fa-edit"></i> {{trans('edit')}}
                                                                                    </a>
                                                                                    <button type="button"
                                                                                            class="dropdown-item has-icon"
                                                                                            data-toggle="modal"
                                                                                            data-target="#deleteEmployerModel{{ $employer->id }}">
                                                                                        <i class="fa fa-trash"></i> {{trans('remove')}}
                                                                                    </button>
                                                                                </div>
                                                                            </div>

                                                                        </td>
                                                                    </tr>
                                                                @endforeach


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade p-0" id="contact3" role="tabpanel"
                                         aria-labelledby="contact-tab3">
                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 mx-auto">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row">


                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="example-2"
                                                                   class="table table-striped table-bordered border-t0 text-nowrap w-100">
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
                                                                    <th style="width: 1px">{{ trans('actions') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($agenciesList as $agency)
                                                                    <tr>
                                                                        <td>{{ $agency->id }}</td>
                                                                        <td> {{ $agency->name}} </td>
                                                                        <td>{{ $agency->phone }}</td>
                                                                        <td>{{ $agency->email }}</td>
                                                                        <td>{{ $agency->address }}</td>
                                                                        <td>{{ $agency->location->parent ? $agency->location->parent->name: '--'}}</td>
                                                                        <td>{{ $agency->location ? $agency->location->name: '--'}}</td>
                                                                        <td>
                                                                            <label class="custom-switch">
                                                                                <input type="checkbox" name="active"
                                                                                       id="active"
                                                                                       data-model="{{get_class($agency)}}"
                                                                                       data-id="{{ $agency->id }}"
                                                                                       value="{{ $agency->active }}"
                                                                                       {{ $agency->active ? 'checked' : '' }} class="custom-switch-input">
                                                                                <span
                                                                                    class="custom-switch-indicator publish"></span>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <div class="btn-group dropdown">
                                                                                <button type="button"
                                                                                        class="btn btn-sm btn-info m-b-5 m-t-5 dropdown-toggle"
                                                                                        data-toggle="dropdown"
                                                                                        aria-haspopup="true"
                                                                                        aria-expanded="false">
                                                                                    <i class="fa-cog fa"></i>
                                                                                </button>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item has-icon"
                                                                                       href="{{ route('admin.agencies.edit', ['agency' => $agency]) }}"><i
                                                                                            class="fa fa-edit"></i> {{ trans('edit') }}
                                                                                    </a>
                                                                                    <button type="button"
                                                                                            class="dropdown-item has-icon"
                                                                                            data-toggle="modal"
                                                                                            data-target="#delete_model_{{ $agency->id }}">
                                                                                        <i class="fa fa-trash"></i> {{ trans('remove') }}
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
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


                <!-- row cloesd -->
                <div class="row row-deck">
                    <div class="col-lg-6 col-xl-6 col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ trans('graphical_comparison_report') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="text-center">
                                        <div class="mb-2">
                                            <h6 class=" mb-1">{{ trans('total_revenue') }}</h6>
                                            <h3 class=" mb-2">15,730</h3>
                                            <span class="text-success"><i
                                                    class="zmdi zmdi-long-arrow-up zmdi-hc-lg mr-2"></i><span>+24%</span></span><span
                                                class="text-muted ml-2">{{ trans('from_last_month') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <canvas id="barChart" class="chartjs-render-monitor  h-250"></canvas>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-xl-6 col-md-12 col-12">
                        <div class="card overflow-hidden">
                            <div class="card-header">
                                <h4>{{ trans('report_to_join') }}</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="sales-chart" class="chartjs-render-monitor chart-dropshadow h-350"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
                <!--row closed-->


            </div>


        </section>


        @foreach ($agenciesList as $agency)
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

        @foreach ($employersList as $employer)
            <div class="modal fade" id="deleteEmployerModel{{ $employer->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="deleteEmployerModelTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteEmployerModelTitle">{{trans('delete')}}</h5>
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

        @foreach ($seekersList as $seeker)
            <div class="modal fade" id="deleteModelSeeker{{ $seeker->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="deleteModelSeekerTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModelSeekerTitle">{{trans('delete')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.seekers.destroy', ['seeker' => $seeker]) }}" method="Post">
                            @method('DELETE')
                            @csrf
                            <div class="modal-body">
                                <p class="mb-0">{{trans('delete_confirmation_message')}}</p>
                                <input type="hidden" name="redirectSeekers" value="1">
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
    <!--app-content closed-->

@stop


@section('scripts')
    <script type="text/javascript">

        $(function () {
            /*---ChartJS (#barChart)---*/
            var ctx = document.getElementById("barChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($industriesNames); ?> ,
                    datasets: [{
                        label: "seekerCounts",
                        data:<?php echo json_encode($seekerCounts); ?> ,
                        borderColor: "#7673e6",
                        borderWidth: "0",
                        barWidth: "1",
                        backgroundColor: "#7673e6"
                    }, {
                        label: "offline",
                        data: [28, 48, 40, 19, 86, 27, 90],
                        borderColor: "#f47b25",
                        borderWidth: "0",
                        barWidth: "1",
                        backgroundColor: "#f47b25"
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                            },
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontColor: "rgba(0,0,0,0.5)",
                            },
                            gridLines: {
                                display: false
                            },
                        }]
                    },
                    legend: {
                        labels: {
                            fontColor: "rgba(0,0,0,0.5)"
                        },
                    },
                }
            });
            /*---ChartJS (#barChart) closed---*/


            /*---ChartJS (#sales-chart)---*/
            var ctx = document.getElementById("sales-chart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($userChartsAllData['days']); ?>,
                    type: 'line',
                    datasets: [{
                        label: "seeker",
                        data: <?php echo json_encode($userChartsAllData['seeker']); ?>,
                        backgroundColor: 'transparent',
                        borderColor: '#7673e6',
                        borderWidth: 3,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: '#7673e6',
                    }, {
                        label: "owner",
                        data: <?php echo json_encode($userChartsAllData['owner']); ?>,
                        backgroundColor: 'transparent',
                        borderColor: '#f47b25',
                        borderWidth: 3,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: '#f47b25',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        cornerRadius: 3,
                        intersect: false,
                    },
                    legend: {
                        display: false,
                        labels: {
                            usePointStyle: true,
                            fontFamily: 'Montserrat',
                        },
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                            },
                            display: true,
                            gridLines: {
                                display: true,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: false,
                                labelString: 'Month',
                                fontColor: 'rgba(0,0,0,0.61)'
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                            },
                            display: true,
                            gridLines: {
                                display: true,
                                drawBorder: false
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Value',
                                fontColor: 'rgba(0,0,0,0.61)'
                            }
                        }]
                    },
                    title: {
                        display: false,
                        text: 'Normal Legend'
                    }
                }
            });
            /*---ChartJS (#sales-chart) closed---*/

        });

        function range(start, end) {
            if (start === end) return [start];
            return [start, ...range(start + 1, end)];
        }

    </script>
@endsection
