<div class="card">
    <div class="card-body">
        <center class="m-t-30">
            <img title="{{$piece->name}}" src="{{getImageUrl('Piece',$piece->image)}}" class="rounded-circle" width="150" />
            <h4 class="nameOfUser card-title m-t-10">{{$piece->name}}</h4>
            <h6 class="card-subtitle">{{$piece->quantity}}</h6>
            <div class="row text-center justify-content-md-center">
            </div>
        </center>
    </div>
    <div>
        <hr> </div>
    <div class="card-body">
        <small class="text-muted">{{trans('admins.name')}} </small><h6>{{$piece->name }}</h6>
        <small class="text-muted">{{trans('admins.pieceNumber')}} </small><h6>{{$piece->pieceNumber }}</h6>
        <small class="text-muted">{{trans('admins.quantity')}} </small><h6>{{$piece->quantity }}</h6>
        <small class="text-muted">{{trans('admins.newPiece')}} </small><h6>{{$piece->newStore }}</h6>
        <small class="text-muted">{{trans('admins.usedPiece')}} </small><h6>{{$piece->usedStore }}</h6>
        <small class="text-muted">{{trans('admins.DamagedPiece')}} </small><h6>{{$piece->damgedStore }}</h6>
        <small class="text-muted">{{arabicSingleWords(). trans('admins.singleCategory')}} </small><h6>{{$piece->cat ? $piece->cat->name :''}}</h6>

{{--        <small class="text-muted p-t-30 db">Social Profile</small>--}}
{{--        <br/>--}}
{{--        <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>--}}
{{--        <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>--}}
{{--        <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button>--}}
    </div>
</div>
