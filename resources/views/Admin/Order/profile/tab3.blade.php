<div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12" style="margin-bottom : 12px">
                <ul class="list-group customOrder">
                    <li class="list-group-item d-flex justify-content-between  align-items-center">
                        <h4>
                           {{trans('admins.order_details')}}
                        </h4>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('admins.price')}}
                        <span class="badge badge-info">{{$order->price}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('admins.singleCategory')}}
                        <span class="badge badge-info">{{$order->cat ? $order->cat->name :''}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('admins.code')}}
                        <span class="badge badge-info">{{$order->id}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('admins.Technical')}}
                        <span class="badge badge-info">{{$order->technical ? $order->technical->name : trans('admins.noTechnical')}}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('basic.status')}}
                        <span class="badge badge-{{getStatusAndBtn($order->status,1)[0]}}">{{getStatusAndBtn($order->status,1)[1]}}</span>
                    </li>

                </ul>
            </div>
            <br>
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        client info
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('admins.name')}}
                        <span class="">{{$order->tenant->name}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('admins.phone')}}
                        <span class="">{{$order->tenant->phone}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('admins.nationality')}}
                        <span class="">{{$order->tenant->nationality}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('main.family_num')}}
                        <span class="">{{$order->tenant->montior->count()}}</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('admins.singleVilla')}}
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('admins.villaNumber')}}
                        <span class="">{{ $order->tenant->villa->villa_number}}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{trans('admins.singleCompounds')}}
                        <span class="">{{$order->tenant->villa->compound->compound_name}}</span>
                    </li>

                </ul>
            </div>

        </div>
    </div>
</div>