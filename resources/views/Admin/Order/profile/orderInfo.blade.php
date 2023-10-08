<div class="card">
    <div class="card-body">
        <center class="m-t-30">
            <img title="" src="{{getImageUrl('Villas',$order->tenant->villa->image)}}" class="rounded-circle" width="150" />
            <h4 class="nameOfUser card-title m-t-10">{{$order->tenant->name}}</h4>
            <h6 class="card-subtitle">{{$order->tenant->phone}}</h6>
            <div class="row text-center justify-content-md-center">
            </div>
        </center>
    </div>
    <div>
        <hr> </div>
    <div class="card-body">
        <small class="text-muted">{{trans('admins.client_name')}}</small><h6>{{$order->tenant->name}}</h6>
        <small class="text-muted p-t-30 db">{{trans('admins.MaintenanceType')}}</small><h6>
                {{getMaintenanceType($order->type)}}
        </h6>
        <small class="text-muted p-t-30 db">{{trans('basic.status')}}</small><h6>{{getStatusAndBtn($order->status,1)[1]}}</h6>
        <small class="text-muted p-t-30 db">{{trans('admins.singleCategory')}}</small><h6>{{$order->cat ? $order->cat->name : ''}}</h6>
        <div class="map-box">
            <div id="map" style="width: 100%; height: 200px;"></div>
        </div>
{{--        <small class="text-muted p-t-30 db">Social Profile</small>--}}
{{--        <br/>--}}
{{--        <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>--}}
{{--        <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>--}}
{{--        <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>--}}
    </div>
</div>
