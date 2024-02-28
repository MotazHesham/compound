<?php


namespace App\Http\Controllers\Admin;

use App\Models\Villas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Compound;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class TenantController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Tenant::orderBy('id','desc');
        $data=$data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $villas = Villas::all();
        return view('Admin.Tenant.index',compact('villas'));
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $ten=Tenant::where('villa_id',$request->villa_id)->first();
        if(!is_null($ten)){
            $msg = 'الفيلا محجوزة لمستاجر اخر';
            return $this->apiResponseMessage(2,$msg,200);
        }
        $this->save_Tenant($request,new Tenant);
        return $this->apiResponseMessage(1,trans('basic.addedSuccess'),200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Tenant = Tenant::find($id);
        return $Tenant;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $ten=Tenant::where('villa_id',$request->villa_id)->where('id','!=',$request->id)->first();
        if(!is_null($ten)){
            $msg = 'الفيلا محجوزة لمستاجر اخر';
            return $this->apiResponseMessage(2,$msg,200);
        }
        $Tenant = Tenant::find($request->id);
        $this->save_Tenant($request,$Tenant);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param $request
     * @param $Compound
     */
    public function save_Tenant($request,$Tenant){
        $Tenant->id_number=$request->id_number;
        $Tenant->nationality=$request->nationality;
        $Tenant->name=$request->name;
        $Tenant->phone=$request->phone;
        $Tenant->anotherPhone=$request->anotherPhone;
        $Tenant->companyName=$request->companyName;
        $Tenant->companyManger=$request->companyManger;
        $Tenant->companyMangerPhone=$request->companyMangerPhone;
        $Tenant->companyMangerEmail=$request->companyMangerEmail;
        $Tenant->contractNumber=$request->contractNumber;
        $Tenant->contractDate=$request->contractDate;
        $Tenant->villa_id =$request->villa_id ;
        $Tenant->contractAmount =$request->contractAmount ;
        $Tenant->contractType =$request->contractType ;
        $Tenant->email =$request->email ;
        if(isset($request->password)){
            $Tenant->password = bcrypt($request->password) ;
        }
        $Tenant->save();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show ($id){
        $tenant=Tenant::find($id);
        return view('Admin.Tenant.show',compact('tenant'));
    }
    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function destroy($id,Request $request)
    {
        if ($request->type == 2) {
            $ids = explode(',', $id);
            $Tenant = Tenant::whereIn('id', $ids)->get();
            foreach($Tenant as $row){
                $this->deleteRow($row);
            }
        } else {
            $Tenant = Tenant::find($id);
            $this->deleteRow($Tenant);
        }
        return response()->json(['errors' => false,'msg'=>trans('basic.deleteSuccess')]);
    }

    /**
     * @param $Tenant
     */
    private function deleteRow($Tenant){
        $Tenant->delete();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function sendEmails (Request $request){
        if($request->ids) {
            $ids = explode(',', $request->ids);
            $Tenants = Tenant::whereIn('id', $ids)->pluck('email')->toArray();
        }else{
            $Tenants = Tenant::pluck('email')->toArray();
        }
        send_emails($Tenants,$request->title,$request->contentEmail);
        return $this->apiResponseMessage(1,trans('basic.sendMailSuccess'),200);
    }
    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    private function mainFunction($data)
    {
        return Datatables::of($data)->addColumn('action', function ($data) {
            $options = '<td class="sorting_1"><button  class="btn btn-info waves-effect btn-circle waves-light" onclick="editFunction(' . $data->id . ')" type="button" ><i class="fa fa-spinner fa-spin" id="loadEdit_' . $data->id . '" style="display:none"></i><i class="sl-icon-wrench"></i></button>';
            $options .= ' <button type="button" onclick="deleteFunction(' . $data->id . ',1)" class="btn btn-dribbble waves-effect btn-circle waves-light"><i class="sl-icon-trash"></i> </button></td>';
            $options .= ' <a title="'.trans("basic.details").'" href="'.route("Tenant.show",$data->id).'" target="_blank"  class="btn btn-success waves-effect btn-circle waves-light"><i class="icon-Eye"></i> </a></td>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->editColumn('villa_id', function ($data) {
            return $data->villa? $data->villa->villa_number .' / ' .$data->villa->compound->compound_name :'' ;
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','status_id'=>'status_id'])->make(true);
    }
}
