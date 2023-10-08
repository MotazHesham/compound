<?php


namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Villas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Piece;
use App\Models\Compound;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class PieceController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Piece::orderBy('id','desc');
        $data=$data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $cats = Category::where('type',1)->get();
        $vills=Villas::get();
        $WarehouseType=$request->WarehouseType;
        return view('Admin.Piece.index',compact('WarehouseType','cats','vills'));
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {

        $this->save_Piece($request,new Piece,0);
        return $this->apiResponseMessage(1,trans('basic.addedSuccess'),200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Piece = Piece::find($id);
        return $Piece;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $Piece = Piece::find($request->id);
        $this->save_Piece($request,$Piece,null);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param $request
     * @param $Piece
     * @param $quantity
     */
    public function save_Piece($request,$Piece,$quantity){
        $Piece->pieceNumber=$request->pieceNumber;
        $Piece->name=$request->name;
        if($quantity)
            $Piece->quantity=$quantity;
        $Piece->cat_id =$request->cat_id ;
        if($request->image){
            deleteFile('Piece',$Piece->image);
            $Piece->image=saveImage('Piece',$request->image);
        }
        $Piece->save();
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
            $Piece = Piece::whereIn('id', $ids)->get();
            foreach($Piece as $row){
                $this->deleteRow($row);
            }
        } else {
            $Piece = Piece::find($id);
            $this->deleteRow($Piece);
        }
        return response()->json(['errors' => false,'msg'=>trans('basic.deleteSuccess')]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $piece=Piece::find($id);
        $vills=Villas::get();
        return view('Admin.Piece.profile.profile',compact('piece','vills'));
    }
    /**
     * @param $Piece
     */
    private function deleteRow($Piece){
        deleteFile('Piece',$Piece->image);
        $Piece->delete();
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
            $options .= ' <a type="button" href="/Admin/Piece/show/'.$data->id.'" target="_blank" class="btn btn-success waves-effect btn-circle waves-light"><i class="icon-Add"></i> </a></td>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->editColumn('image', function ($data) {
            $image = '<a href="'. getImageUrl('Piece',$data->image).'" target="_blank">'
                .'<img  src="'. getImageUrl('Piece',$data->image) . '" width="50px" height="50px"></a>';
            return $image;
        })->editColumn('cat_id', function ($data) {
            return $data->cat ? $data->cat->name : '';
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','image'=>'image'])->make(true);
    }
}
