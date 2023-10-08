<div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 col-xs-6 b-r"> <strong>عدد العروض</strong>
                <br>
                <p class="text-muted">{{$order->exchangeOrders->count()}}</p>
            </div>
            <div class="col-md-3 col-xs-6 b-r"> <strong>سعر الطلب الكلي</strong>
                <br>
                <p class="text-muted">{{$order->total_price}}</p>
            </div>
            <div class="col-md-3 col-xs-6 b-r"> <strong>سعر المنتجات</strong>
                <br>
                <p class="text-muted">{{$order->product_price}}</p>
            </div>
            <div class="col-md-3 col-xs-6"> <strong>سعر التوصيل المقترح من العضو</strong>
                <br>
                <p class="text-muted">{{$order->suggest_shipping_price}}</p>
            </div>
        </div>
        <hr>
        <p class="m-t-30"></p>
        <h4 class="font-medium m-t-30"> العروض لهذا الطلب</h4>
        <hr>
        @if($order->exchangeOrders->count() > 0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">اسم السائق</th>
                <th scope="col">السعر المقترح</th>
                <th scope="col">وقت العرض</th>
                <th scope="col">المعلومات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->exchangeOrders as $row)
            <tr>
                <th scope="row">1</th>
                <td>{{$row->name}}</td>
                <td>{{$row->price}}</td>
                <td>{{$row->created_at}}</td>
                <td>
                    <button title="معلومات العرض" onclick="OfferInfo('{{$row->id}}')" class="btn btn-success waves-effect btn-circle waves-light"><i class=" fas fa-info"></i><i class="fa fa-spinner fa-spin" id="offerInfo_{{$row->id}}" style="display:none"></i> </button>
                </td>
            </tr>
                @endforeach

            </tbody>
        </table>
            @else
            <h5 class="font-medium m-t-30"> لا توجد عروض متوفرة</h5>

        @endif

    </div>
</div>
