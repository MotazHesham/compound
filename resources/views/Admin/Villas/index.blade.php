@extends('Admin.includes.layouts.master')

@section('title')
    {{trans('admins.Villas')}}
@endsection


@section('content')

    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">{{getNameInIndexPage()}}</h4>
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
                                <li class="breadcrumb-item active" aria-current="page">{{trans('admins.Villas')}} </li>
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
            <!-- basic table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center m-b-30">
                                <h4 class="card-title">{{trans('admins.Villas')}} </h4>
                                <div class="ml-auto">
                                    <div class="btn-group">
                                        <button type="button" id="showmenu" class="btn btn-dark fillterNew">
                                            <i class="fas fa-filter"></i>
                                        </button>
                                        <button class="btn btn-dark" id="titleOfText" data-toggle="modal"
                                                onclick="addFunction()">
                                            {{trans('basic.add')}} {{trans('admins.singleVilla')}}
                                        </button>
                                        &nbsp;
                                        <button class="btn btn-danger " data-toggle="modal"
                                                onclick="deleteFunction(0,2)">
                                            {{trans('basic.delete_marked')}}
                                        </button>

                                    </div>

                                </div>
                            </div>
                            <div class="menuFilter" style="display: none;">
                                <form id="seachForm">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-2">
                                            <div class="form-group">
                                                <select name="compound_id" class="custom-select mr-sm-2"
                                                        id="inlineFormCustomSelect">
                                                    <option value="">{{arabicSingleWords().trans('admins.singleCompounds')}}</option>
                                                    @foreach($compound as $row)
                                                        <option value="{{$row->id}}">{{$row->compound_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-2">
                                            <div class="form-group">
                                                <select name="status" class="custom-select mr-sm-2" id="inline">
                                                    <option value="">{{arabicSingleWords().trans('admins.singleStatus')}}</option>
                                                    <option value="1">{{trans('admins.NotAvailableVillas')}}</option>
                                                    <option value="2">{{trans('admins.availableVillas')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-1">
                                            <div class="form-actions">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-info">بحث</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive" style="overflow: hidden;">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="sorting_asc" tabindex="0" aria-controls="file_export" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label=" : activate to sort column descending" style="width: 0px;"></th>
                                        <th>#</th>
                                        <th>{{trans('admins.image')}}</th>
                                        <th>{{trans('admins.villaNumber')}}</th>
                                        <th>{{trans('admins.number_of_rooms')}}</th>
                                        <th>{{trans('admins.number_of_bathrooms')}}</th>
                                        <th>{{arabicSingleWords(). trans('admins.singleCompounds')}}</th>
                                        <th>{{trans('basic.options')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
        <!-- footer -->
        <!-- ============================================================== -->
    @include('Admin.Villas.form')

    <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#showmenu').click(function () {
                $('.menuFilter').toggle("slide");
            });
        });
    </script>
    @include('Admin.Villas.script')

@endsection
