<div class="card-group">
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-danger">
                                        <i class="ti-clipboard text-white"></i>
                                    </span>
                </div>
                <div>
                    {{trans('Tenant.myOrders')}}
                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{\App\Models\Order::where('tenant_id',TenantData()->id)->count()}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg btn-info">
                                        <i class=" icon-Add-User text-white"></i>
                                    </span>
                </div>
                <div>
                    {{trans('Tenant.myFamily')}}
                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{\App\Models\Monitors::where('tenant_id',TenantData()->id)->count()}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-success">
                                        <i class=" icon-Newsvine text-white"></i>
                                    </span>
                </div>
                <div>
                    {{trans('admins.new_orders')}}

                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{\App\Models\Order::where('tenant_id',TenantData()->id)->where('status',1)->count()}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="m-r-10">
                                    <span class="btn btn-circle btn-lg bg-warning">
                                        <i class="icon-Address-Book2 text-white"></i>
                                    </span>
                </div>
                <div>
                    {{trans('admins.completed_orders')}}

                </div>
                <div class="ml-auto">
                    <h2 class="m-b-0 font-light">{{\App\Models\Order::where('tenant_id',TenantData()->id)->where('status',5)->count()}}</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Card -->
    <!-- Column -->


</div>
