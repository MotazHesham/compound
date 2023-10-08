<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile dropdown m-t-20">
                        <div class="user-pic">

                            <img src="{{getTenantImage()}}" alt="users"
                                 class="rounded-circle img-fluid"/>

                        </div>
                        <div class="user-content hide-menu m-t-10">
                            <h5 class="nameOfUser m-b-10 user-name font-medium">{{ TenantData()->name }}</h5>
                            <a href="javascript:void(0)" class="btn btn-circle btn-sm m-r-5" id="Userdd" role="button"
                               data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i class="ti-settings"></i>
                            </a>
                            <a href="javascript:void(0)" title="Logout" class="btn btn-circle btn-sm">
                                <i class="ti-power-off"></i>
                            </a>
                            <div class="dropdown-menu animated flipInY" aria-labelledby="Userdd">
{{--                                <a class="dropdown-item" href="{{route('profile.index')}}">--}}
                                    <a class="dropdown-item" href="{{route('Tenant.logout')}}">
                                        <i class="fa fa-power-off m-r-5 m-l-5"></i> logout</a>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- main routes section-->

                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{route('Tenant.dashboard')}}"
                       aria-expanded="false">
                        <i class="fa fa-home"></i>
                        <span class="hide-menu">{{trans('admins.home')}}</span>
                    </a>
                </li>

{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link  waves-effect waves-dark" href="{{route('MonitorsTenant.index')}}"--}}
{{--                       aria-expanded="false">--}}
{{--                        <i class="icon-Add-UserStar"></i>--}}
{{--                        <span class="hide-menu">{{trans('Tenant.myFamily')}}</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{route('OrderTenant.index')}}"
                       aria-expanded="false">
                        <i class="icon-Man-Sign"></i>
                        <span class="hide-menu">{{trans('Tenant.myOrders')}}</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">{{trans('admins.Reservations')}}</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{route('PartyT.index')}}"
                       aria-expanded="false">
                        <i class="icon-Add-Window"></i>
                        <span class="hide-menu">{{trans('admins.busDates')}}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{route('BookingParty.index')}}"
                       aria-expanded="false">
                        <i class="icon-Aerobics-2"></i>
                        <span class="hide-menu">{{trans('admins.busBooking')}}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{route('TParty2.index')}}"
                       aria-expanded="false">
                        <i class=" icon-Affiliate"></i>
                        <span class="hide-menu">{{trans('admins.Party2')}}</span>
                    </a>
                </li>
                <!--end main routes section-->

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
