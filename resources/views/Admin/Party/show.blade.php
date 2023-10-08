@extends('Admin.includes.layouts.master')

@section('title')
    {{$party->bus->name}}
@endsection

@section('content')

    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">date Details</h4>
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
                                <li class="breadcrumb-item active" aria-current="page">{{$party->name}}</li>
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
                            <h3 class="card-title">{{$party->bus->name}}</h3>
                            <h6 class="card-subtitle">{{$party->date}}</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="white-box text-center"><img style="width: 285px ; height: 355px"
                                                                            src="{{getImageUrl('Party',$party->image)}}"
                                                                            class="img-responsive"></div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-6">
                                    <h4 class="box-title m-t-40">description</h4>
                                    <p>{{$party->desc}}</p>
                                    <h2 class="m-t-40">{{$party->from}} - {{$party->to}}</h2>

                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h3 class="box-title m-t-40">{{trans('admins.Subscribers')}}</h3>
                                    @if($party->tenants->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>id</th>
                                                <th>name</th>
                                                <th>villa</th>
                                                <th>members numbers</th>
                                                <th>Subscribe date</th>
                                            </tr>
                                            @foreach($party->tenants as $row)
                                                <tr>
                                                    <td >{{$row->id}}</td>
                                                    <td >{{$row->name}}</td>
                                                    <td >{{$row->villa ? $row->villa->villa_number : '' }} / {{$row->villa ? $row->villa->compound->compound_name :''}}</td>
                                                    <td >{{$row->pivot->numbers}}</td>
                                                    <td> {{$row->pivot->created_at}}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                        @else
                                        <h5>no Subscribers yet!!</h5>
                                    @endif
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
        <!-- footer -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    @include('Tenant.Party.form')

@endsection


@section('script')
    <script>
        $(document).ready(function () {
            $('#showmenu').click(function () {
                $('.menuFilter').toggle("slide");
            });
        });
    </script>
    @include('Tenant.Party.script')

@endsection