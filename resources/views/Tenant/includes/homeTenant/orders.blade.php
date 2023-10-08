@php
    $orders=\App\Models\Order::take(7)->orderBy('id','desc')->where('tenant_id',TenantData()->id)->get();
@endphp
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <!-- title -->
                <div class="d-md-flex align-items-center">
                    <div>
                        <h4 class="card-title">{{trans('admins.lastOrders')}}</h4>
                    </div>

                </div>
                <!-- title -->
            </div>
            <div class="table-responsive">
                <table class="table v-middle">
                    <thead>
                    <tr class="bg-light">
                        <th class="border-top-0">{{trans('admins.MaintenanceType')}}</th>
                        <th class="border-top-0">{{trans('admins.singleCategory')}}</th>
                        <th class="border-top-0">{{trans('admins.suggestDate')}}</th>
                        <th class="border-top-0">{{trans('admins.created_at')}}</th>
                        <th class="border-top-0">{{trans('basic.status')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $row)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="m-r-10">
                                    <a class="btn btn-circle btn-{{getStatusAndBtn($row->status,1)[0]}} text-white">{{$row->id}}</a>
                                </div>
                                <div class="">
                                    <h4 class="m-b-0 font-16">{{getMaintenanceType($row->type) }}</h4>
                                </div>
                            </div>
                        </td>
                        <td>{{$row->cat ? $row->cat->name : ''}}</td>

                        <td>{{$row->suggestDate}}</td>
                        <td>
                            <h5 class="m-b-0">{{$row->created_at}}</h5>
                        </td>
                        <td>
                            <label class="label label-{{getStatusAndBtn($row->status,1)[0]}} ">{{getStatusAndBtn($row->status,1)[1]}}</label>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
