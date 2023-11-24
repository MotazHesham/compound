<?php


namespace App\Http\Controllers\Admin;

use App\Models\Piece;
use App\Models\Villas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\exchangeOrder;
use App\Models\Compound;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class exchangeOrderController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = exchangeOrder::orderBy('id', 'desc');
        if ($request->piece_id)
            $data = $data->where('piece_id', $request->piece_id);
        if ($request->order_id)
            $data = $data->where('order_id', $request->order_id);
        $data = $data->get();
       // return $data;
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $vills = Villas::all();
        $order_id=$request->order_id;
        $piece = Piece::where('quantity', '>', 0)->get();
        return view('Admin.exchangeOrder.index', compact('vills', 'piece','order_id'));
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {

        $this->save_exchangeOrder($request, new exchangeOrder);
        $piece = Piece::find($request->piece_id);
        addQuantityToPiece(-$request->quantity, $piece, $request->type);
        return $this->apiResponseMessage(1, trans('basic.addedSuccess'), 200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $exchangeOrder = exchangeOrder::find($id);
        return $exchangeOrder;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $exchangeOrder = exchangeOrder::find($request->id);
        $this->save_exchangeOrder($request, $exchangeOrder);
        return $this->apiResponseMessage(1, trans('basic.editedSuccess'), 200);
    }

    /**
     * @param $request
     * @param $exchangeOrder
     */
    public function save_exchangeOrder($request, $exchangeOrder)
    {
        // $exchangeOrder->piece_id = $request->piece_id;
        // $exchangeOrder->admin_id = $request->admin_id;
        // $exchangeOrder->technical_id = $request->technical_id;
        // $exchangeOrder->order_id = $request->order_id;
        // $exchangeOrder->quantity = $request->quantity;
        // $exchangeOrder->type = $request->type;
        $exchangeOrder->price = $request->price;
        $exchangeOrder->status = $request->status;
        $exchangeOrder->save();
    }

    /**
     * @param Request $request
     * @param $id
     * @return int
     */
    public function ChangeStatus(Request $request, $id)
    {
        $exchangeOrder = exchangeOrder::find($id);
        $exchangeOrder->status = $request->status;
        $exchangeOrder->save();
        return 1;
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function destroy($id, Request $request)
    {
        if ($request->type == 2) {
            $ids = explode(',', $id);
            $exchangeOrder = exchangeOrder::whereIn('id', $ids)->get();
            foreach ($exchangeOrder as $row) {
                $this->deleteRow($row);
            }
        } else {
            $exchangeOrder = exchangeOrder::find($id);
            $this->deleteRow($exchangeOrder);
        }
        return response()->json(['errors' => false, 'msg' => trans('basic.deleteSuccess')]);
    }

    /**
     * @param $exchangeOrder
     */
    private function deleteRow($exchangeOrder)
    {
        $exchangeOrder->delete();
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    private function mainFunction($data)
    {
        return Datatables::of($data)->addColumn('action', function ($data) {
            $options='';
            if (in_array(adminInfo()->roleType, [1, 2]))
                $options = ' <button type="button" onclick="deleteFunction2(' . $data->id . ',1)" class="btn btn-dribbble waves-effect btn-circle waves-light"><i class="sl-icon-trash"></i> </button></td>';
            if (in_array(adminInfo()->roleType, [1, 2]))
                $options .= ' <button type="button" onclick="changeStatus(' . $data->id . ',1)" title="'.trans('admins.acceptable').'" class="btn btn-success waves-effect btn-circle waves-light"><i class="icon-Security-Check"></i> </button></td>';
            if (in_array(adminInfo()->roleType, [1, 2]))
                $options .= ' <button type="button" onclick="changeStatus(' . $data->id . ',2)" title="'.trans('admins.unacceptable').'" class="btn btn-danger waves-effect btn-circle waves-light"><i class=" icon-Close-Window"></i> </button></td>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->addColumn('admin_id', function ($data) {
            return $data->admin ? $data->admin->name : '';
        })->addColumn('piece_id', function ($data) {
            return $data->Piece ? $data->Piece->name : '';
        })->editColumn('images', function ($data) {
            $images = $data->description . '<br>';
            if($data->images && json_decode($data->images)){
                foreach(json_decode($data->images) as $image){
                    $images .= '<a style="padding:2px" href="'. get_baseUrl() .  str_replace('public','/public/storage',$image) .'" target="_blank">'
                        .'<img  src="'. get_baseUrl() . str_replace('public','/public/storage',$image) . '" width="50px" height="50px"></a>';
                }
            }
            return $images;
        })->addColumn('technical_id', function ($data) {
            return $data->order->technical ? $data->order->technical->name : '';
        })->editColumn('villa_id', function ($data) {
            return $data->order ? $data->order->tenant->villa->villa_number . ' / ' . $data->order->tenant->villa->compound->compound_name : '';
        })->editColumn('status', function ($data) {
            if ($data->status == 3)
                $status = '<button class="btn waves-effect waves-light btn-rounded btn-info statusBut" >'.trans('admins.in_review').'</button>';
            if ($data->status == 2)
                $status = '<button class="btn waves-effect waves-light btn-rounded btn-danger statusBut" >'.trans('admins.unacceptable').'</button>';
            if ($data->status == 1){
                $status = '<button class="btn waves-effect waves-light btn-rounded btn-success statusBut" >'.trans('admins.acceptable').'</button>';
                $status .= $data->price ? ' <br> السعر:' . $data->price : '';
            }
            return $status;
        })->rawColumns(['action' => 'action', 'checkBox' => 'checkBox', 'status' => 'status','images' => 'images'])->make(true);
    }
}
