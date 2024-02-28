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
                                <label for="example-email">{{trans('admins.name')}}</label>
                                <input type="text" id="name" name="name" required class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.phone')}}</label>
                                <input type="text" id="phone" required name="phone" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.email')}}</label>
                                <input type="email" id="email" required name="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.password')}}</label>
                                <input type="password" id="password"   name="password" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.anotherPhone')}}</label>
                                <input type="text" id="anotherPhone" name="anotherPhone" class="form-control">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.id_number')}}</label>
                                <input type="number" id="id_number" name="id_number" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.nationality')}}</label>
                                <select type="text" id="nationality" name="nationality"  class="form-control"   >
                                    @include('Admin.includes.layouts.countrirs')
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.companyName')}}</label>
                                <input type="text" id="companyName" name="companyName" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.companyManger')}}</label>
                                <input type="text" id="companyManger" name="companyManger" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.companyMangerPhone')}}</label>
                                <input type="text" id="companyMangerPhone" name="companyMangerPhone" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.companyMangerEmail')}}</label>
                                <input type="text" id="companyMangerEmail" name="companyMangerEmail" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('admins.singleVilla')}}</label>
                                <select class="custom-select col-12" id="villa_id" required name="villa_id">
                                    <option value="">{{trans('basic.choose')}} </option>
                                    @foreach($villas as $row)
                                        <option value="{{$row->id}}">{{$row->villa_number}}  / {{$row->compound->compound_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.contractNumber')}}</label>
                                <input type="text" id="contractNumber" required name="contractNumber" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.contractDate')}}</label>
                                <input type="Date" id="contractDate" required name="contractDate" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.contractAmount')}}</label>
                                <input type="number" step="0.01" id="contractAmount" required name="contractAmount" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.contractType')}}</label>
                                <select id="contractType"  name="contractType" class="form-control">
                                    <option value="1">{{trans('admins.annual')}}</option>
                                    <option value="2">{{trans('admins.Semi_annual')}}</option>
                                    <option value="3">{{trans('admins.quarterly')}}</option>
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
