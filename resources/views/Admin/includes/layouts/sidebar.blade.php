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

                            <img src="{{getAdminImage(Auth::guard('Admin')->user()->photo)}}" alt="users"
                                 class="rounded-circle img-fluid"/>

                        </div>
                        <div class="user-content hide-menu m-t-10">
                            <h5 class="nameOfUser m-b-10 user-name font-medium">{{ Auth::guard('Admin')->user()->name }}</h5>
                            <a href="javascript:void(0)" class="btn btn-circle btn-sm m-r-5" id="Userdd" role="button"
                               data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i class="ti-settings"></i>
                            </a>
                            <a href="javascript:void(0)" title="Logout" class="btn btn-circle btn-sm">
                                <i class="ti-power-off"></i>
                            </a>
                            <div class="dropdown-menu animated flipInY" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="{{route('profile.index')}}">
                                    <a class="dropdown-item" href="{{route('user.logout')}}">
                                        <i class="fa fa-power-off m-r-5 m-l-5"></i> تسجيل الخروج</a>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- main routes section-->

                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{route('admin.dashboard')}}"
                       aria-expanded="false">
                        <i class="fa fa-home"></i>
                        <span class="hide-menu">{{trans('admins.home')}}</span>
                    </a>
                </li>
            @if(adminInfo()->roleType !=3)
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">{{trans('admins.Administration')}}</span>
                </li>
                {{-- basicInformation --}}
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="icon-Information"></i>
                        <span class="hide-menu"> {{trans('admins.basicInformation')}} </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">

                        @foreach(slidersMainLinks('basicInformation') as $row)
                            <li class="sidebar-item">
                                <a class="sidebar-link  waves-effect waves-dark" href="{{$row[1]}}"
                                   aria-expanded="false">
                                    <i class="icon-Information"></i>
                                    <span class="hide-menu">{{$row[0]}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                {{--Warehouse--}}
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="icon-Clothing-Store"></i>
                        <span class="hide-menu"> {{trans('admins.Warehouse')}} </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">

                        @foreach(slidersMainLinks('Warehouse') as $row)
                            <li class="sidebar-item">
                                <a class="sidebar-link  waves-effect waves-dark" href="{{$row[1]}}"
                                   aria-expanded="false">
                                    <i class="icon-Information"></i>
                                    <span class="hide-menu">{{$row[0]}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{route('exchangeOrder.index')}}"
                       aria-expanded="false">
                        <i class="icon-Spell-Check"></i>
                        <span class="hide-menu">{{trans('admins.exchangeOrder')}}</span>
                    </a>
                </li>
                <!--Maintenance routes section-->
                @endif
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">{{trans('admins.Maintenance')}}</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark" href="{{route('Order.index')}}"
                       aria-expanded="false">
                        <i class="sl-icon-wrench"></i>
                        <span class="hide-menu">{{trans('admins.maintenanceOrders')}}</span>
                    </a>
                </li>
                <!--end Maintenance routes section-->

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">{{trans('admins.Reservations')}}</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="icon-Information"></i>
                        <span class="hide-menu"> {{trans('admins.buses')}} </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a class="sidebar-link  waves-effect waves-dark" href="{{route('Bus.index')}}"
                               aria-expanded="false">
                                <i class="icon-Parrot"></i>
                                <span class="hide-menu">{{trans('admins.buses')}}</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link  waves-effect waves-dark" href="{{route('Party.index')}}"
                               aria-expanded="false">
                                <i class="icon-Parrot"></i>
                                <span class="hide-menu">{{trans('admins.Party')}}</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="icon-Parrot"></i>
                        <span class="hide-menu"> {{trans('admins.Party2')}} </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">

                        <li class="sidebar-item">
                            <a class="sidebar-link  waves-effect waves-dark" href="{{route('PartyType.index')}}"
                               aria-expanded="false">
                                <i class="icon-Parrot"></i>
                                <span class="hide-menu">{{trans('admins.PartyType')}}</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link  waves-effect waves-dark" href="{{route('Party2.index')}}"
                               aria-expanded="false">
                                <i class="icon-Parrot"></i>
                                <span class="hide-menu">{{trans('admins.Party2Booking')}}</span>
                            </a>
                        </li>
                    </ul>
                </li>



            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
