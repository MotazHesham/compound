@extends('Admin.includes.layouts.master')
@section('title')
    {{ $piece->name }}
@endsection

@section('style')
    <style>
        .customOrder span{
            font-size: 12px;
        }
    </style>
    @endsection

@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">{{ $piece->name }}</h4>
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
                                <li class="breadcrumb-item active" aria-current="page">{{ $piece->name }}</li>
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
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-4 col-xlg-3 col-md-5">
                    @include('Admin.Piece.profile.info')
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <!-- Tabs -->
                        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#current-month" role="tab" aria-controls="pills-timeline" aria-selected="true"> {{trans('admins.invoice')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab" aria-controls="pills-profile" aria-selected="false">{{trans('admins.exchangeOrder')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-DestroyOrder-tab" data-toggle="pill" href="#DestroyOrder" role="tab" aria-controls="pills-profile" aria-selected="false">{{trans('admins.DestroyOrder')}}</a>
                            </li>
                        </ul>
                        <!-- Tabs -->
                        <div class="tab-content" id="pills-tabContent">
                            @include('Admin.Piece.profile.tab1')
                            @include('Admin.Piece.profile.tab2')
                            @include('Admin.Piece.profile.tab3')
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
            <!-- Row -->
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

    </div>

    @include('Admin.Piece.profile.formInvoice')
    @include('Admin.Piece.profile.FormExchanged')
    @include('Admin.Piece.profile.DestroyForm')

@endsection

@section('script')
@include('Admin.Piece.profile.scripExchanged')
@include('Admin.Piece.profile.scriptInvoice')
@include('Admin.Piece.profile.DestroyScript')
    <script>

    </script>
@endsection