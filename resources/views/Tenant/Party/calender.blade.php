@extends('Tenant.includes.layouts.master')
@section('style')
    <link href="/Admin/assets/libs/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <link href="/Admin/assets/extra-libs/calendar/calendar.css" rel="stylesheet" />
@endsection
@section('title')
    {{trans('admins.busDates')}}
@endsection


@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">{{trans('admins.busDates')}}</h4>
                    <div class="d-flex align-items-center">

                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="">
                                    <div class="row">
                                        <div class="col-lg-3 border-right p-r-0">
                                            <div class="card-body border-bottom">
                                                <h4 class="card-title m-t-10">color info</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="calendar-events" class="">
                                                            <div class="calendar-events m-b-20" data-class="bg-info"><i class="fa fa-circle text-info m-r-10"></i>{{trans('admins.my_booking')}}</div>
                                                            <div class="calendar-events m-b-20" data-class="bg-success"><i class="fa fa-circle text-success m-r-10"></i> {{trans('admins.up_coming_bus')}}</div>
                                                            <div class="calendar-events m-b-20" data-class="bg-danger"><i class="fa fa-circle text-danger m-r-10"></i>{{trans('admins.completed_Trips')}}</div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="card-body b-l calender-sidebar">
                                                <div id="calendar"></div>
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
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body b-l calender-sidebar">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <div class="chat-windows"></div>


@endsection

@section('script')

    <script src="/Admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/Admin/assets/extra-libs/taskboard/js/jquery.ui.touch-punch-improved.js"></script>
    <script src="/Admin/assets/extra-libs/taskboard/js/jquery-ui.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="/Admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="/Admin/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="/Admin/dist/js/app.min.js"></script>
    <script src="/Admin/dist/js/app.init.js"></script>
    <script src="/Admin/dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="/Admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/Admin/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="/Admin/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/Admin/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/Admin/dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="/Admin/assets/libs/moment/min/moment.min.js"></script>
    <script src="/Admin/assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
    <script>
    </script>
    @include('Tenant.Party.calenderScript')


@endsection