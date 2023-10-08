@extends('Tenant.includes.layouts.master')

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
                    <h4 class="page-title">bus Details</h4>
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
                                <li class="breadcrumb-item active" aria-current="page">{{$party->bus->name}}</li>
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
                            <h6 class="card-subtitle">{{$party->date}} {{$party->time}}</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="white-box text-center"> <img style="width: 285px ; height: 355px" src="{{getImageUrl('Party',$party->image)}}" class="img-responsive"> </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-6">
                                    <h4 class="box-title m-t-40">description</h4>
                                    <p>{{$party->desc}}</p>
                                    <h2 class="m-t-40">{{$party->from}} {{$party->to}}</h2>
                                    <button onclick="bookParty('{{$party->id}}')" class="btn btn-primary btn-rounded"> book Now </button>

                                </div>
{{--                                <div class="col-lg-12 col-md-12 col-sm-12">--}}
{{--                                    <h3 class="box-title m-t-40">General Info</h3>--}}
{{--                                    <div class="table-responsive">--}}
{{--                                        <table class="table">--}}
{{--                                            <tbody>--}}
{{--                                            <tr>--}}
{{--                                                <td width="390">Brand</td>--}}
{{--                                                <td> Stellar </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Delivery Condition</td>--}}
{{--                                                <td> Knock Down </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Seat Lock Included</td>--}}
{{--                                                <td> Yes </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Type</td>--}}
{{--                                                <td> Office Chair </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Style</td>--}}
{{--                                                <td> Contemporary &amp; Modern </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Wheels Included</td>--}}
{{--                                                <td> Yes </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Upholstery Included</td>--}}
{{--                                                <td> Yes </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Upholstery Type</td>--}}
{{--                                                <td> Cushion </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Head Support</td>--}}
{{--                                                <td> No </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Suitable For</td>--}}
{{--                                                <td> Study &amp; Home Office </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Adjustable Height</td>--}}
{{--                                                <td> Yes </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Model Number</td>--}}
{{--                                                <td> F01020701-00HT744A06 </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Armrest Included</td>--}}
{{--                                                <td> Yes </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Care Instructions</td>--}}
{{--                                                <td> Handle With Care, Keep In Dry Place, Do Not Apply Any Chemical For Cleaning. </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>Finish Type</td>--}}
{{--                                                <td> Matte </td>--}}
{{--                                            </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
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
        $(document).ready(function(){
            $('#showmenu').click(function() {
                $('.menuFilter').toggle("slide");
            });
        });
    </script>
    @include('Tenant.Party.script')

@endsection