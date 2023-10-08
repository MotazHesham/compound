@extends('Tenant.includes.layouts.master')

@section('title')
{{trans('Tenant.myOrders')}}
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
                                    <a href="{{route('Tenant.dashboard')}}">{{trans('admins.home')}}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{trans('Tenant.myOrders')}} </li>
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
                                <h4 class="card-title">{{trans('Tenant.myOrders')}} </h4>
                                <div class="ml-auto">
                                    <div class="btn-group">
                                        <button type="button" id="showmenu" class="btn btn-dark fillterNew">
                                            <i class="fas fa-filter"></i>
                                        </button>
                                        <button  class="btn btn-dark" id="titleOfText" data-toggle="modal" onclick="addFunction()">
                                            {{trans('basic.add')}} {{getLang() =='en' ? 'service request' : 'طلب صيانة'}}
                                        </button>
                                        &nbsp;
                                        <button  class="btn btn-danger " data-toggle="modal" onclick="deleteFunction(0,2)">
                                            {{trans('basic.delete_marked')}}
                                        </button>

                                    </div>

                                </div>
                            </div>
                            <h6 class="card-subtitle"></h6>

                            <div class="menuFilter" style="display: none;">
                                <form id="seachForm">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <select name="status" class="custom-select mr-sm-2"  id="inline">
                                                    <option value="">{{trans('basic.status')}}</option>
                                                    @foreach(orderStatuses(1) as $row)
                                                        <option value="{{$row['id']}}">{{$row['name']}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <select name="cat_id" class="custom-select mr-sm-2"  id="inline">
                                                    <option value="">{{arabicSingleWords(). trans('admins.singleCategory')}}</option>
                                                    @foreach(getCats(1) as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <select name="type" class="custom-select mr-sm-2"  id="inline">
                                                    <option value="">{{ trans('admins.MaintenanceType')}}</option>
                                                        <option value="1">{{trans('admins.Regular_maintenance')}}</option>
                                                        <option value="2">{{trans('admins.Emergency_maintenance')}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-1">
                                            <div class="form-actions">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-info">{{trans('admins.search')}}</button>
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
                                        <th class="sorting_asc" tabindex="0" aria-controls="file_export" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" : activate to sort column descending" style="width: 0px;"> </th>
                                        <th>#</th>
                                        <th>{{trans('admins.image')}}</th>
                                        <th>{{trans('admins.MaintenanceType')}}</th>
                                        <th>{{trans('admins.singleCategory')}}</th>
                                        <th>{{trans('basic.status')}}</th>
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
    @include('Tenant.Order.form')

    <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#showmenu').click(function() {
                $('.menuFilter').toggle("slide");
            });
        });
    </script>
    @include('Tenant.Order.script')

@endsection
