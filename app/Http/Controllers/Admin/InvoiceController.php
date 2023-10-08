<?php


namespace App\Http\Controllers\Admin;

use App\Models\Piece;
use App\Models\Villas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Compound;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class InvoiceController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Invoice::orderBy('id', 'desc');
        if ($request->piece_id)
            $data = $data->where('piece_id', $request->piece_id);
        $data = $data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('Admin.Invoice.index');
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {

        $this->save_Invoice($request, new Invoice);
        $piece=Piece::find($request->piece_id);
        addQuantityToPiece($request->quantity,$piece,1);
        return $this->apiResponseMessage(1, trans('basic.addedSuccess'), 200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Invoice = Invoice::find($id);
        return $Invoice;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $Invoice = Invoice::find($request->id);
        $this->save_Invoice($request, $Invoice);
        return $this->apiResponseMessage(1, trans('basic.editedSuccess'), 200);
    }

    /**
     * @param $request
     * @param $Invoice
     * @return mixed
     */
    public function save_Invoice($request, $Invoice)
    {
        $Invoice->supplierName = $request->supplierName;
        $Invoice->price = $request->price;
        $Invoice->quantity = $request->quantity;
        $Invoice->piece_id = $request->piece_id;
        if($request->image){
            deleteFile('Invoice',$Invoice->image);
            $Invoice->image=saveImage('Invoice',$request->image);
        }
        $Invoice->save();
        return $Invoice;
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
            $Invoice = Invoice::whereIn('id', $ids)->get();
            foreach ($Invoice as $row) {
                $this->deleteRow($row);
            }
        } else {
            $Invoice = Invoice::find($id);
            $this->deleteRow($Invoice);
        }
        return response()->json(['errors' => false, 'msg' => trans('basic.deleteSuccess')]);
    }

    /**
     * @param $Invoice
     */
    private function deleteRow($Invoice)
    {
        $Invoice->delete();
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
        })->addColumn('piece_id', function ($data) {
            return $data->Piece ? $data->Piece->name :'';
        })->editColumn('image', function ($data) {
            $image = '<a href="'. getImageUrl('Invoice',$data->image).'" target="_blank">'
                .'<img  src="'. getImageUrl('Invoice',$data->image) . '" width="50px" height="50px"></a>';
            return $image;
        })->rawColumns(['action' => 'action', 'checkBox' => 'checkBox', 'status_id' => 'status_id','image'=>'image'])->make(true);
    }
}
