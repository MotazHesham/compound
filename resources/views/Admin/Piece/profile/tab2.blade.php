<div class="tab-pane fade" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
    <div class="card-body">

        <h4 class="font-medium m-t-30"> {{trans('admins.exchangeOrder')}}</h4>
        <hr>
{{--        <button  class="btn btn-dark" id="titleOfWork" data-toggle="modal" onclick="addFunction2()">--}}
{{--            {{trans('basic.add')}} {{trans('admins.singleOrder')}}--}}
{{--        </button>--}}
        <br>
        <table class="table" id="datatable2"  style="width : 100% !important;">
            <thead>
            <tr>
                <th class="sorting_asc" tabindex="0" aria-controls="file_export" rowspan="1" colspan="1" aria-sort="ascending" aria-label=" : activate to sort column descending" style="width: 0px;"> </th>
                <th>#</th>
                <th>{{arabicSingleWords(). trans('admins.admin')}}</th>
                <th>{{arabicSingleWords(). trans('admins.quantity')}}</th>
                <th>{{arabicSingleWords(). trans('admins.Technical')}}</th>
                <th>{{arabicSingleWords(). trans('admins.singlePiece')}}</th>
                <th>{{arabicSingleWords(). trans('admins.singleVilla')}}</th>
                <th>{{arabicSingleWords(). trans('admins.status')}}</th>
                <th>{{trans('basic.options')}}</th>

            </tr>
            </thead>
            <tbody>


            </tbody>
        </table>

    </div>
</div>
