<?php


namespace App\Http\Controllers\Admin;

use App\Models\Bus;
use App\Models\Category;
use App\Models\Villas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Party2;
use App\Models\Compound;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class Party2Controller extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Party2::orderBy('id','desc');
        $data=$data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $bus = Bus::get();
        return view('Admin.Party2.index',compact('bus'));
    }



    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Party2 = Party2::find($id);
        return $Party2;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $Party2 = Party2::find($request->id);
        $this->save_Party2($request,$Party2,null);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param $request
     * @param $Party2
     * @param $quantity
     */
    public function save_Party2($request,$Party2,$quantity){
        $Party2->status=$request->status;
        $Party2->save();
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
            $Party2 = Party2::whereIn('id', $ids)->get();
            foreach($Party2 as $row){
                $this->deleteRow($row);
            }
        } else {
            $Party2 = Party2::find($id);
            $this->deleteRow($Party2);
        }
        return response()->json(['errors' => false,'msg'=>trans('basic.deleteSuccess')]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $Party2 =Party2::find($id);
        return view('Admin.Party2.show',compact('Party2'));
    }
    /**
     * @param $Party2
     */
    private function deleteRow($Party2){
        deleteFile('Party2',$Party2->image);
        $Party2->delete();
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
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->editColumn('tenant_id', function ($data) {
            return $data->tenant ? $data->tenant->name : '';
        })->editColumn('status', function ($data) {
            $array=getBookingStatusAndBtn($data->status);
            $status = '<button class="btn waves-effect waves-light btn-rounded btn-'.$array[0].' statusBut" >'.$array[1].'</button>';
            return $status;
        })->editColumn('type', function ($data) {
            return $data->type ? $data->type->name_ar : '';
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','status'=>'status'])->make(true);
    }
}
