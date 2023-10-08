<div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
    <div class="card-body">
        <h4 class="font-medium m-t-30"> invoices</h4>
        <hr>
        <button  class="btn btn-dark" id="titleOfText" data-toggle="modal" onclick="addFunction()">
            Add new invoice
        </button>
        <br>
            <table class="table" id="datatable">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{trans('admins.image')}}</th>
                    <th scope="col">supplier Name</th>
                    <th scope="col">price</th>
                    <th scope="col">quantity</th>
                    <th>{{trans('admins.created_at')}}</th>
                    <th scope="col">options</th>
                </tr>
                </thead>
                <tbody>


                </tbody>
            </table>

    </div>
</div>
