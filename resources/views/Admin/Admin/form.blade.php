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

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.name')}}</label>
                                <input type="text" id="name" name="name" required class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.email')}}</label>
                                <input type="email" id="email" required name="email"  class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.phone')}}</label>
                                <input type="number" id="phone" name="phone"  class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.password')}}</label>
                                <input type="text" id="password" name="password"  class="form-control"   >
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.nationality')}}</label>
                                <select type="text" id="nationality" name="nationality"  class="form-control"   >
                                    @include('Admin.includes.layouts.countrirs')
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.id_number')}}</label>
                                <input type="number" id="id_number" name="id_number"  class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.job')}}</label>
                                <input type="text" id="job" name="job"  class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{arabicSingleWords(). trans('admins.department')}}</label>
                                <select  id="administration" name="administration"  class="form-control"   >
                                @foreach(getCats(2) as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">{{trans('admins.image')}}</label>
                                <input type="file" id="image" name="image"  class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{trans('admins.roleType')}}</label>
                                <select class="custom-select col-12" id="roleType"  name="roleType" >
                                    <option value="">{{trans('basic.choose')}} </option>
                                    @foreach(AdminsROlesTypes() as $row)
                                        <option value="{{$row[0]}}">{{$row[1]}} </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>التعاقد</label>
                                <select class="custom-select col-12" id="contract_type"  name="contract_type" required>
                                    <option value="">{{trans('basic.choose')}} </option> 
                                    <option value="on_bail">علي الكفالة</option> 
                                    <option value="subcontractor">متعاقد من الباطن</option> 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" id="on_bail" style="display: none"> 
                            <div class="form-group">
                                <label for="example-email">الرقم الوظيفي</label>
                                <input type="text" id="job_num" name="job_num"  class="form-control">
                            </div> 
                        </div>
                        <div class="col-md-12" id="subcontractor" style="display: none">
                            <div class="row"> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-email">اسم الشركة/المؤسسة</label>
                                        <input type="text" id="company_name" name="company_name"  class="form-control">
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">النشاط</label>
                                        <input type="text" id="company_field" name="company_field"  class="form-control">
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">رقم السجل</label>
                                        <input type="text" id="commerical_num" name="commerical_num"  class="form-control">
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">صورة السجل</label>
                                        <input type="file" id="commerical_image" name="commerical_image"  class="form-control"   >
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">اسم المدير العام</label>
                                        <input type="text" id="manager_name" name="manager_name"  class="form-control">
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">الجوال</label>
                                        <input type="text" id="manager_phone" name="manager_phone"  class="form-control">
                                    </div> 
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">البريد الألكتروني</label>
                                        <input type="text" id="manager_email" name="manager_email"  class="form-control"   >
                                    </div> 
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-email">العنوان والمدينة</label>
                                        <input type="text" id="company_address" name="company_address"  class="form-control"   >
                                    </div> 
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-email">الموقع الألكتروني للشركة</label>
                                        <input type="text" id="company_website" name="company_website"  class="form-control"   >
                                    </div> 
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>صفة التعاقد</label>
                                        <select class="custom-select col-12" id="contract_by"  name="contract_by">
                                            <option value="">{{trans('basic.choose')}} </option> 
                                            <option value="ajir">نظام اجير</option> 
                                            <option value="external">عقد تعاون خارجي</option> 
                                        </select>
                                    </div> 
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-email">صورة العقد</label>
                                        <input type="file" id="contract_image" name="contract_image"  class="form-control"   >
                                    </div> 
                                </div> 
                                <div class="col-md-12" style="display: none" id="contact_dates">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-email">بداية العقد</label>
                                                <input type="date" id="contract_start" name="contract_start"  class="form-control"   >
                                            </div> 
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-email">نهاية العقد</label>
                                                <input type="date" id="contract_end" name="contract_end"  class="form-control"   >
                                            </div> 
                                        </div> 
                                    </div>
                                </div> 
                                <div class="col-md-4 mt-3">
                                    بيانات المفوض
                                    <hr>
                                </div> 
                                <div class="col-md-8 mb-2">
                                </div> 

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">الاسم الرباعي</label>
                                        <input type="text" id="commissioner_name" name="commissioner_name"  class="form-control"   >
                                    </div> 
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">{{trans('admins.nationality')}}</label>
                                        <select type="text" id="commissioner_nationality" name="commissioner_nationality"  class="form-control"   >
                                            @include('Admin.includes.layouts.countrirs')
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">{{trans('admins.id_number')}}</label>
                                        <input type="number" id="commissioner_id_number" name="commissioner_id_number"  class="form-control"   >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">صورة الهوية</label>
                                        <input type="file" id="commissioner_id_image" name="commissioner_id_image"  class="form-control"   >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">تاريخ الأصدار</label>
                                        <input type="date" id="commissioner_id_start" name="commissioner_id_start"  class="form-control"   >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">تاريخ الأنتهاء </label>
                                        <input type="date" id="commissioner_id_end" name="commissioner_id_end"  class="form-control"   >
                                    </div>
                                </div>
        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">المسمي الوظيفي</label>
                                        <input type="text" id="commissioner_job" name="commissioner_job"  class="form-control"   >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">صورة خطاب التكليف</label>
                                        <input type="file" id="commissioner_image" name="commissioner_image"  class="form-control"   >
                                    </div>
                                </div>
        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">{{trans('admins.phone')}}</label>
                                        <input type="number" id="commissioner_phone" name="commissioner_phone"  class="form-control"   >
                                    </div>
                                </div>
        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-email">البريد الألكتروني</label>
                                        <input type="email" id="commissioner_email" name="commissioner_email"  class="form-control"   >
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="err"></div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">{{trans('basic.close')}}</button>
                    <button type="submit" id="save" class="btn btn-success"><i class="ti-save"></i> save</button>
                </div>
            </form>
        </div>
    </div>
</div>
