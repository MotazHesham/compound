
<div class="modal fade bd-example-modal-lg" id="formModel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="formSubmit">
                @csrf
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="status" value="1">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleOfModel"><i class="ti-marker-alt m-r-10"></i> Add new </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row"> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-email">السعر</label>
                            <input type="text" id="price" name="price" required class="form-control"   >
                        </div>
                    </div> 
                    </div>
                </div>
                <div id="err"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">{{trans('basic.close')}}</button>
                    <button type="submit" id="save" class="btn btn-success"><i class="ti-save"></i> {{trans('basic.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
