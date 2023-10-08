@extends('Tenant.includes.layouts.master')

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
                <div class="col-7 align-self-center">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('Tenant.dashboard')}}">{{trans('admins.home')}}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{trans('admins.busDates')}}</li>
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
            @foreach(getParty() as $row)
                <!-- Column -->
                    <div class="col-lg-4">
                        <div class="card">
                            <a href="{{route('PartyT.show',$row->id)}}">
                                <img class="card-img-top img-responsive" style="height: 254px;width: 382px"
                                     src="{{getImageUrl('Party',$row->image)}}" alt="Card image cap">
                            </a>
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center m-b-15">
                                    <span><i class="ti-calendar"></i> {{$row->date}} </span>
                                    <div class="ml-auto">
                                        <a href="javascript:void(0)" class="link"><i
                                                    class="icon-Over-Time"></i> {{$row->from}} - {{$row->to}}</a>
                                    </div>
                                </div>
                                <h3 class="font-normal">{{$row->bus->name}}</h3>
                                <p class="m-b-0 m-t-10">{{substr($row->desc,0,200)}}</p>
                                <button onclick="bookParty('{{$row->id}}')"
                                        class="btn btn-success btn-rounded waves-effect waves-light m-t-20">book now
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
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
