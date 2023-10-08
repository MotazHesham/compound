<div class="modal fade" id="showData" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> order details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6 showDetilse">
                            <h5><i class="icon-Lock-User"></i>{{trans('admins.singleCategory')}}</h5>
                            <p class="valueModal" id="cat_idShow"></p>
                        </div>

                        <div class="col-md-6 showDetilse">
                            <h5><i class="icon-Email"></i>{{trans('admins.MaintenanceType')}}</h5>
                            <p class="main valueModal" id="typeShow"></p>
                        </div>

                        <div class="col-md-6 showDetilse">
                            <h5><i class="icon-Calendar-3"></i>{{trans('admins.suggestDate')}}</h5>
                            <p class="valueModal" id="suggestDateShow"></p>
                        </div>


                        <div class="col-md-6 showDetilse">
                            <h5><i class="icon-Calendar-3"></i>{{trans('admins.created_at')}}</h5>
                            <p class="valueModal" id="created_at"></p>
                        </div>

                        <div class="col-md-6 showDetilse">
                            <h5><i class="icon-Arrow-Join"></i>{{trans('admins.clientName')}}</h5>
                            <p class="valueModal" id="tenant_id"></p>
                        </div>

                        <div class="col-md-6 showDetilse">
                            <h5><i class="icon-Arrow-Join"></i>{{trans('admins.superName')}}</h5>
                            <p class="valueModal" id="super_idShow"></p>
                        </div>

                        <div class="col-md-6 showDetilse">
                            <h5><i class="icon-Arrow-Join"></i>{{trans('admins.technicalName')}}</h5>
                            <p class="valueModal" id="technical_idShow"></p>
                        </div>

                        <div class="col-md-6 showDetilse">
                            <h5><i class="icon-Arrow-Join"></i>{{trans('admins.price')}}</h5>
                            <p class="valueModal" id="priceShow"></p>
                        </div>

                        <div class="col-md-12 showDetilse">
                            <h5><i class="fas fa-pencil-alt"></i>{{trans('admins.Required')}}</h5>
                            <textarea class=" valueModal" readonly id="RequiredShow" style="width: 100%"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('basic.close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

