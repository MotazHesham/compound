<?php


namespace App\Http\Controllers\Admin;

use App\Models\AdminType;
use App\Models\Category;
use App\Models\InvoiceSale;
use App\Models\MoneyDaily;
use App\Models\role;
use App\Models\Store;
use App\Reposatries\MoneyRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Yajra\DataTables\DataTables;
use Auth, File ,Hash;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Admin::orderBy('id','desc')->where('id','!=',1);
        $data=$data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Admin.Admin.index');
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create (Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:admin|min:3',
                'password' => 'required',
                'email' => 'required|unique:admin',
            ],
            getLang() =='ar' ?
            [
                'name.required' => 'من فضلك ادخل اسم المستخدم',
                'password.required' => 'من فضلك ادخل كلمة السر',
                'email.required' => 'من فضلك ادخل البريد الالكتروني',
                'email.unique' => 'هذا البريد الالكتروني مسجل لدينا لمستخدم اخر',
                'name.unique' => 'هذا الاسم مسجل لدينا لمستخدم اخر',
                'name.min' => 'يجب ان لا يقل عدد حروف اسم المستخدم عن ثلاثة احرف'
            ]
                :
                []

        );
        $Admin =$this->save_admin(new Admin(),$request);
        $Admin->roles()->attach(1);
        return $this->apiResponseMessage(1,trans('basic.addedSuccess'),200);
    }

    /**
     * @param $Admin
     * @param $roles
     */
//    private function save_role($Admin,$roles){
//        $Admin->roles()->detach();
//        $Admin->roles()->attach(1);
//        if($roles) {
//            foreach ($roles as $row) {
//                $Admin->roles()->attach($row);
//            }
//        }
//    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Admin = Admin::find($id);
        $Admin['roles_ids']=adminsRoleArray($Admin);
        return $Admin;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:admin,name,'.$request->id.'|min:3',
                'email' => 'required|unique:admin,email,'.$request->id,
            ],
            getLang() =='ar' ?
                [
                    'name.required' => 'من فضلك ادخل اسم المستخدم',
                    'email.required' => 'من فضلك ادخل البريد الالكتروني',
                    'email.unique' => 'هذا البريد الالكتروني مسجل لدينا لمستخدم اخر',
                    'name.unique' => 'هذا الاسم مسجل لدينا لمستخدم اخر',
                    'name.min' => 'يجب ان لا يقل عدد حروف اسم المستخدم عن ثلاثة احرف'
                ]
                :
                []

        );
        $Admin = Admin::find($request->id);
        $this->save_admin($Admin,$request);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param $Admin
     * @param $request
     * @return mixed
     */
    private function save_admin($Admin,$request){
        $Admin->name = $request->name;
        $Admin->phone = $request->phone;
        $Admin->email = $request->email;
        $Admin->id_number = $request->id_number;
        $Admin->administration = $request->administration;
        $Admin->nationality  = $request->nationality;
        $Admin->roleType = $request->roleType;
        $Admin->job = $request->job;
        if($request->password)
            $Admin->password = Hash::make($request->password);
        if($request->image){
            deleteFile('Admin',$Admin->image);
            $Admin->image=saveImage('Admin',$request->image);
        }
        $Admin->contract_type = $request->contract_type;
        $Admin->job_num = $request->job_num;
        $Admin->company_name = $request->company_name;
        $Admin->company_field = $request->company_field;
        $Admin->commerical_num = $request->commerical_num;
        $Admin->manager_name = $request->manager_name;
        $Admin->manager_phone = $request->manager_phone;
        $Admin->manager_email = $request->manager_email;
        $Admin->company_address = $request->company_address;
        $Admin->company_website = $request->company_website;
        $Admin->contract_by = $request->contract_by;
        $Admin->contract_start = $request->contract_start;
        $Admin->contract_end = $request->contract_end;
        $Admin->commissioner_name = $request->commissioner_name;
        $Admin->commissioner_nationality = $request->commissioner_nationality;
        $Admin->commissioner_id_number = $request->commissioner_id_number;
        $Admin->commissioner_id_start = $request->commissioner_id_start;
        $Admin->commissioner_id_end = $request->commissioner_id_end;
        $Admin->commissioner_job = $request->commissioner_job;
        $Admin->commissioner_phone = $request->commissioner_phone; 
        $Admin->commissioner_email = $request->commissioner_email; 
        if($request->commissioner_image){
            deleteFile('commissioner_image',$Admin->commissioner_image);
            $Admin->commissioner_image=saveImage('commissioner_image',$request->commissioner_image);
        }
        if($request->commissioner_id_image){
            deleteFile('commissioner_id_image',$Admin->commissioner_id_image);
            $Admin->commissioner_id_image=saveImage('commissioner_id_image',$request->commissioner_id_image);
        }
        if($request->commerical_image){
            deleteFile('commerical_image',$Admin->commerical_image);
            $Admin->commerical_image=saveImage('commerical_image',$request->commerical_image);
        }
        if($request->contract_image){
            deleteFile('contract_image',$Admin->contract_image);
            $Admin->contract_image=saveImage('contract_image',$request->contract_image);
        }
        $Admin->save();
        return $Admin;
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
            $Categories = Admin::whereIn('id', $ids)->where('id','!=',1)->get();
            foreach($Categories as $row){
                deleteFile('Admin',$row->image);
                $row->delete();
            }
        } else {
            $Admin = Admin::find($id);
            if (is_null($Admin)) {
                return 5;
            }
            deleteFile('Admin',$Admin->image);
            $Admin->delete();
        }
        return response()->json(['errors' => false,'msg'=>trans('basic.deleteSuccess')]);
    }

    /**
     * @param $admin_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProfile ($admin_id){
        $admin=Admin::find($admin_id);
        return view('Admin.Admin.AdminProfile.profile',compact('admin'));
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
           if($data->id != 1)
               $options .= ' <button type="button" onclick="deleteFunction(' . $data->id . ',1)" class="btn btn-dribbble waves-effect btn-circle waves-light"><i class="sl-icon-trash"></i> </button></td>';
            return $options;
        })->editColumn('image', function ($data) {
            $image = '<a href="'. getImageUrl('Admin',$data->image).'" target="_blank">'
                .'<img  src="'. getImageUrl('Admin',$data->image) . '" width="50px" height="50px"></a>';
            return $image;
        })->editColumn('roleType', function ($data) {
            return roleTypeName($data->roleType);
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->rawColumns(['action' => 'action', 'type_id' => 'type_id','checkBox'=>'checkBox','image'=>'image'])->make(true);
    }
}
