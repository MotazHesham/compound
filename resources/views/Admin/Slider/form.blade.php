<div class="modal fade bd-example-modal-lg" id="formModel" tabindex="-1" role="dialog"
     aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="formSubmit">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="titleOfModel"><i class="ti-marker-alt m-r-10"></i> Add new </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.Slidertext')}}</label>
                                <input type="text" id="text" name="text" required class="form-control">
                            </div>
                        </div> 
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-email">Link</label>
                                <input type="text" id="link" name="link" required class="form-control">
                            </div>
                        </div> 


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.image')}}</label>
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('admins.Slidertype')}}</label>
                                <select class="custom-select col-12" id="type" required name="type">
                                    <option value="">{{trans('basic.choose')}} </option> 
                                    <option value="application">Application </option> 
                                </select>
                            </div>
                        </div>


                    </div>
                </div>
                <div id="err"></div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{trans('basic.close')}}</button>
                    <button type="submit" id="save" class="btn btn-success"><i class="ti-save"></i> save</button>
                </div>
            </form>
        </div>
    </div>
</div>
