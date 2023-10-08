<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{getLogo()}}">
    <title>login</title>
    <!-- Custom CSS -->
    <link href="/Admin/dist/css/style.min.css" rel="stylesheet">
    <link href="/Admin/toast/jquery.toast.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(/Admin/auth-bg.jpg) no-repeat center center;">
        <div class="auth-box">
            <div id="loginform">
                <div class="logo">
                    <span class="db"><img src="{{getLogo()}}" alt="logo" width="30px" /></span>
                    <h5 class="font-medium m-b-20">login</h5>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal m-t-20"  id="login_form">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="username" aria-label="Username" name="name" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                </div>
                                <input type="password"  class="form-control form-control-lg" placeholder="password" aria-label="Password" name="password" aria-describedby="basic-addon1">
                            </div>
                            {{--                            <div class="form-group row">--}}
                            {{--                                <div class="col-md-12">--}}
                            {{--                                    <div class="custom-control custom-checkbox">--}}
                            {{--                                        <input type="checkbox" class="custom-control-input" id="customCheck1">--}}
                            {{--                                        <label class="custom-control-label" for="customCheck1">Remember me</label>--}}
                            {{--                                        <a href="javascript:void(0)" id="to-recover" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="form-group text-center">
                                <div class="col-xs-12 p-b-20">
                                    <button class="btn btn-block btn-lg btn-info" type="submit" id="save">login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
</div>

@include('Admin.includes.scripts.AlertHelper')
< <!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->

<script src="/Admin/assets/libs/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap tether Core JavaScript -->
<script src="/Admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="/Admin/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<script src="/Admin/dist/js/app.min.js"></script>
<!-- Theme settings -->
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
<!--c3 JavaScript -->
<script src="/Admin/assets/extra-libs/c3/d3.min.js"></script>
<script src="/Admin/assets/extra-libs/c3/c3.min.js"></script>
<script src="/Admin/dist/js/pages/dashboards/dashboard3.js"></script>
<script src="/Admin/toast/jquery.toast.js"></script>

<script>
    $('#login_form').submit(function (e) {
        e.preventDefault();
        $.toast().reset('all');
        $('#buttonLoading').show();
        $("#submit").attr("disabled", true);
        var formData = new FormData($('#login_form')[0]);
        Toset('{{trans('basic.wait')}}','info','{{trans('basic.progress')}}',false);
        $.ajax({
            url: '{{route("admin.login")}}',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $.toast().reset('all');
                $('#buttonLoading').hide();
                $("#submit").attr("disabled", false);
                if (data == 1) {
                    Toset(' registered successfully', 'success', 'You will be directed to the admin page', 800);
                    window.setTimeout(function () {
                        location.href = "{{ route('admin.dashboard') }}";
                    }, 800);
                } else if (data == 2) {
                    Toset('Error', 'error', 'Entry is not permitted by the administrator', false);
                } else if (data == 3) {
                    Toset('Error', 'error', 'The entered data is incorrect', false);
                }
            }
        })
    })
</script>

</body>
</html>