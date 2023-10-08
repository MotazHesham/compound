<div class="modal fade bd-example-modal-lg" id="formModel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
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
                            <label>{{arabicSingleWords(). trans('admins.singleVilla')}}</label>
                            <select class="custom-select col-12" id="villa_id" required name="villa_id">
                                <option value="">{{trans('basic.choose')}} </option>
                                @foreach($vills as $row)
                                    <option value="{{$row->id}}">{{$row->villa_number}} / {{$row->compound->compound_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
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

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{arabicSingleWords(). trans('admins.Technical')}}</label>
                            <select class="custom-select col-12" id="technical_id" required name="technical_id">
                                <option value="">{{trans('basic.choose')}} </option>
                                @foreach(getAdminsByType(3) as $row)
                                    <option value="{{$row->id}}"> {{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="col-md-6">
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

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-email">{{trans('admins.quantity')}}</label>
                            <input type="text" id="quantity" name="quantity" required class="form-control"   >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-email">{{trans('admins.Warehouse')}}</label>
                            <select  id="type" name="type" required class="form-control"   >
                                <option value="1">{{trans('admins.newPiece')}}</option>
                                <option value="2">{{trans('admins.usedPiece')}}</option>
                            </select>
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
