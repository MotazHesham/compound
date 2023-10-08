<div class="modal fade bd-example-modal-lg" id="modalDestroy" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="formDestroy">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="DetailsTitle"><i class="ti-marker-alt m-r-10"></i> {{trans("admins.destroy_order")}} </h5>
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
                                <label>{{arabicSingleWords(). trans('admins.admin')}}</label>
                                <select class="custom-select col-12" id="admin_id2" required name="admin_id">
                                    <option value="">{{trans('basic.choose')}} </option>
                                    @foreach(getAdminsByType(1) as $row)
                                        <option value="{{$row->id}}"> {{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.quantity')}}</label>
                                <input type="text" id="quantity3" name="quantity" required class="form-control"   >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.detailsDestroy')}}</label>
                                <textarea type="text" id="details" name="details"  class="form-control" ></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="err"></div>
                <input type="hidden" name="piece_id" id="piece_id2" value="{{$piece->id}}">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">{{trans('basic.close')}}</button>
                    <button type="submit" id="saveDestroy" class="btn btn-success"><i class="ti-save"></i> {{trans('basic.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
