<?php


namespace App\Http\Controllers\Admin;

use App\Models\Piece;
use App\Models\Villas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DestroyOrder;
use App\Models\Compound;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class DestroyOrderController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = DestroyOrder::orderBy('id','desc');
        $data=$data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $piece = Piece::get();
        return view('Admin.DestroyOrder.index',compact('piece'));
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {

        $this->save_DestroyOrder($request,new DestroyOrder);
        $piece=Piece::find($request->piece_id);
        addQuantityToPiece($request->quantity,$piece,3);
        return $this->apiResponseMessage(1,trans('basic.addedSuccess'),200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $DestroyOrder = DestroyOrder::find($id);
        return $DestroyOrder;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $DestroyOrder = DestroyOrder::find($request->id);
        $this->save_DestroyOrder($request,$DestroyOrder);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param $request
     * @param $DestroyOrder
     */
    public function save_DestroyOrder($request,$DestroyOrder){
        $DestroyOrder->piece_id=$request->piece_id;
        $DestroyOrder->admin_id=$request->admin_id;
        $DestroyOrder->super_id=$request->super_id;
        $DestroyOrder->details=$request->details;
        $DestroyOrder->date=$request->date;
        $DestroyOrder->quantity=$request->quantity;
        $DestroyOrder->save();
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
            $DestroyOrder = DestroyOrder::whereIn('id', $ids)->get();
            foreach($DestroyOrder as $row){
                $this->deleteRow($row);
            }
        } else {
            $DestroyOrder = DestroyOrder::find($id);
            $this->deleteRow($DestroyOrder);
        }
        return response()->json(['errors' => false,'msg'=>trans('basic.deleteSuccess')]);
    }

    /**
     * @param $DestroyOrder
     */
    private function deleteRow($DestroyOrder){
        $DestroyOrder->delete();
    }
    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    private function mainFunction($data)
    {
        return Datatables::of($data)->addColumn('action', function ($data) {
//            $options = '<td class="sorting_1"><button  class="btn btn-info waves-effect btn-circle waves-light" onclick="editFunction(' . $data->id . ')" type="button" ><i class="fa fa-spinner fa-spin" id="loadEdit_' . $data->id . '" style="display:none"></i><i class="sl-icon-wrench"></i></button>';
            $options = ' <button type="button" onclick="deleteFunction3(' . $data->id . ',1)" class="btn btn-dribbble waves-effect btn-circle waves-light"><i class="sl-icon-trash"></i> </button></td>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->addColumn('admin_id', function ($data) {
            return $data->admin ? $data->admin->name :'';
        })->addColumn('piece_id', function ($data) {
            return $data->Piece ? $data->Piece->name :'';
        })->addColumn('super_id', function ($data) {
            return $data->super ? $data->super->name :'';
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','status_id'=>'status_id'])->make(true);
    }
}

