@extends('Admin.includes.layouts.master')

@section('title')
    {{$tenant->name}}
@endsection

@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">{{trans('admins.tenantInfo')}}</h4>
                    <div class="d-flex align-items-center">

                    </div>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.dashboard')}}">{{trans('admins.home')}}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{$tenant->name}}</li>
                            </ol>
                        </nav>
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
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{$tenant->name}}</h3>
                            <h5 class="card-subtitle"> {{$tenant->phone}}</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="white-box text-center"><img width="270"
                                                                            src="/images/helpers/rent.jpg"
                                                                            class="img-responsive"></div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <h3 class="box-title m-t-40">{{trans('admins.basicInformation')}}</h3>
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-check text-info"></i> {{trans('admins.code')}} : {{$tenant->id}}</li>
                                        <li><i class="fa fa-check text-info"></i> {{trans('admins.name')}} : {{$tenant->name}}</li>
                                        <li><i class="fa fa-check text-info"></i> {{trans('admins.nationality')}} : {{$tenant->nationality}}</li>
                                        <li><i class="fa fa-check text-info"></i> {{trans('admins.id_number')}} : {{$tenant->id_number}}</li>
                                        <li><i class="fa fa-check text-info"></i> {{trans('admins.phone')}} : {{$tenant->phone}}</li>
                                        <li><i class="fa fa-check text-info"></i> {{trans('admins.anotherPhone')}} : {{$tenant->anotherPhone}}</li>
                                        <li><i class="fa fa-check text-info"></i> {{trans('admins.created_at')}} : {{$tenant->created_at}}</li>

                                    </ul>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">

                                <h3 class="box-title m-t-40">{{trans('admins.workInformation')}}</h3>
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-check text-success"></i> {{trans('admins.companyName')}} : {{$tenant->companyName}}</li>
                                        <li><i class="fa fa-check text-success"></i> {{trans('admins.companyManger')}} : {{$tenant->companyManger}}</li>
                                        <li><i class="fa fa-check text-success"></i> {{trans('admins.companyMangerPhone')}} : {{$tenant->companyMangerPhone}}</li>
                                        <li><i class="fa fa-check text-success"></i> {{trans('admins.companyMangerEmail')}} : {{$tenant->companyMangerEmail}}</li>

                                    </ul>
                                </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">

                                    <h3 class="box-title m-t-40">{{trans('admins.villaInfo')}}</h3>
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-check text-danger"></i> {{trans('admins.villaNumber')}} : {{$tenant->villa->villa_number}}</li>
                                        <li><i class="fa fa-check text-danger"></i> {{trans('admins.singleCompounds')}} : {{$tenant->villa->compound->compound_name}}</li>
                                        <li><i class="fa fa-check text-danger"></i> {{trans('admins.contractNumber')}} : {{$tenant->contractNumber}}</li>
                                        <li><i class="fa fa-check text-danger"></i> {{trans('admins.contractDate')}} : {{$tenant->contractDate}}</li>

                                    </ul>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <button style="position: relative;top: 62px;{{getLang()=='ar' ? 'left: -1000px;' : 'right: -1000px;'  }}" class="btn btn-dark"
                                            id="titleOfText" data-toggle="modal" onclick="addFunction()">
                                        {{trans('basic.add')}} {{trans('admins.singleMonitors')}}
                                    </button>
                                    <h3 class="box-title m-t-40">{{trans('admins.Monitors')}}</h3>
                                    <div class="table-responsive">
                                        <table class="table" id="datatable">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('admins.name')}}</th>
                                                <th>{{trans('admins.phone')}}</th>
                                                <th>{{trans('admins.relation')}}</th>
                                                <th>{{trans('basic.options')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    @include('Admin.Tenant.MonitorsForm')

@endsection

@section('script')
    @include('Admin.Tenant.MonitorsScript')
@endsection
