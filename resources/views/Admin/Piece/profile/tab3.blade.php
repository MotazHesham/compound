<div class="tab-pane fade" id="DestroyOrder" role="tabpanel" aria-labelledby="pills-DestroyOrder-tab">
    <div class="card-body">

        <h4 class="font-medium m-t-30"> {{trans('admins.DestroyOrder')}}</h4>
        <hr>
        <button  class="btn btn-dark" id="titleOfDestroy" data-toggle="modal" onclick="addFunction3()">
            {{trans('basic.add')}} {{trans('admins.singleOrder')}}
        </button>
        <br>
        <table class="table" id="datatable3"  style="width : 100% !important;">
            <thead>
            <tr>
                <th>#</th>
                <th>{{arabicSingleWords(). trans('admins.admin')}}</th>
                <th>{{arabicSingleWords(). trans('admins.supervisor')}}</th>
                <th>{{arabicSingleWords(). trans('admins.quantity')}}</th>
                <th>{{trans('admins.date')}}</th>
                <th>{{trans('basic.options')}}</th>
            </tr>
            </thead>
            <tbody>


            </tbody>
        </table>

    </div>
</div>
