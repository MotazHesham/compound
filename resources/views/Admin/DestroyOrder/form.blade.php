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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('admins.date')}}</label>
                                <input type="date" class="custom-select col-12" id="date" required name="date">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ trans('quantity.date')}}</label>
                                <input type="number" class="custom-select col-12" id="quantity" required name="quantity">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{arabicSingleWords(). trans('admins.singlePiece')}}</label>
                                <select class="custom-select col-12" id="piece_id" required name="piece_id">
                                    <option value="">{{trans('basic.choose')}} </option>
                                    @foreach($piece as $row)
                                        <option value="{{$row->id}}"> {{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{arabicSingleWords(). trans('admins.admin')}}</label>
                                <select class="custom-select col-12" id="admin_id" required name="admin_id">
                                    <option value="">{{trans('basic.choose')}} </option>
                                    @foreach(getAdminsByType(1) as $row)
                                        <option value="{{$row->id}}"> {{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{arabicSingleWords(). trans('admins.supervisor')}}</label>
                                <select class="custom-select col-12" id="super_id" required name="super_id">
                                    <option value="">{{trans('basic.choose')}} </option>
                                    @foreach(getAdminsByType(2) as $row)
                                        <option value="{{$row->id}}"> {{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.detailsDestroy')}}</label>
                                <textarea type="text" id="details" name="details" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="err"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{trans('basic.close')}}</button>
                    <button type="submit" id="save" class="btn btn-success"><i
                                class="ti-save"></i> {{trans('basic.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
