<div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 col-xs-6 b-r"><strong>{{trans('admins.exchangeOrder')}}</strong>
                <br>
                <p class="text-muted">{{$order->exchangeOrders->count()}}</p>
            </div>
            <div class="col-md-3 col-xs-6 b-r"><strong>{{trans('admins.price')}}</strong>
                <br>
                <p class="text-muted">{{$order->total_price}}</p>
            </div>
            <div class="col-md-3 col-xs-6 b-r"><strong>{{trans('admins.Technical')}}</strong>
                <br>
                <p class="text-muted">{{$order->technical ? $order->technical->name : trans('admins.noTechnical')}}</p>
            </div>
            <div class="col-md-3 col-xs-6"><strong>{{trans('admins.date')}}</strong>
                <br>
                <p class="text-muted">{{$order->created_at}}</p>
            </div>
        </div>
        <hr>
        <p class="m-t-30"></p>
        <h4 class="font-medium m-t-30"> {{trans('admins.exchangeOrder')}}</h4>
        <hr>
        @if($order->exchangeOrders->count() > 0)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{trans('admins.name')}}</th>
                    <th scope="col">{{trans('admins.quantity')}}</th>
                    <th scope="col">{{trans('basic.status')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->exchangeOrders as $row)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{$row->Piece->name}}</td>
                        <td>{{$row->quantity}}</td>
                        <td>
                            @if ($row->status == 3)
                                <button class="btn waves-effect waves-light btn-rounded btn-info statusBut">{{trans('admins.in_review')}}
                                </button>
                            @elseif($row->status == 2)
                                <button class="btn waves-effect waves-light btn-rounded btn-danger statusBut">{{trans('admins.unacceptable')}}
                                </button>
                            @else
                                <button class="btn waves-effect waves-light btn-rounded btn-success statusBut">{{trans('admins.acceptable')}}
                                </button>
                            @endif
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        @else
            <h5 class="font-medium m-t-30"> {{trans('admins.no_exchange_Orders')}}

            </h5>

        @endif

    </div>
</div>
