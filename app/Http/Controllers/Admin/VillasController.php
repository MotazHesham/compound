<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Villas;
use App\Models\Compound;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class VillasController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Villas::orderBy('id','desc');
        if($request->compound_id)
            $data=$data->where('compound_id',$request->compound_id);
        if($request->status==1)
            $data=$data->whereHas('tenant');
        if($request->status==2)
            $data=$data->doesntHave('tenant');
        $data=$data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $compound = Compound::all();
        return view('Admin.Villas.index',compact('compound'));
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {

        $this->save_villa($request,new Villas);
        return $this->apiResponseMessage(1,trans('basic.addedSuccess'),200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Villas = Villas::find($id);
        return $Villas;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {

        $Villas = Villas::find($request->id);
        $this->save_villa($request,$Villas);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param $request
     * @param $Compound
     */
    public function save_villa($request,$Villas){
        $Villas->villa_number=$request->villa_number;
        $Villas->number_of_rooms=$request->number_of_rooms;
        $Villas->number_of_bathrooms=$request->number_of_bathrooms;
        $Villas->other_details=$request->other_details;
        $Villas->compound_id=$request->compound_id;
        if($request->image){
            deleteFile('Villas',$Villas->image);
            $Villas->image=saveImage('Villas',$request->image);
        }
        $Villas->save();
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
            $Villas = Villas::whereIn('id', $ids)->get();
            foreach($Villas as $row){
                $this->deleteRow($row);
            }
        } else {
            $Villas = Villas::find($id);
            $this->deleteRow($Villas);
        }
        return response()->json(['errors' => false,'msg'=>trans('basic.deleteSuccess')]);
    }

    /**
     * @param $Villas
     */
    private function deleteRow($Villas){
        $Villas->delete();
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
        })->editColumn('image', function ($data) {
            $image = '<a href="'. getImageUrl('Villas',$data->image).'" target="_blank">'
                .'<img  src="'. getImageUrl('Villas',$data->image) . '" width="50px" height="50px"></a>';
            return $image;
        })->editColumn('compound_id', function ($data) {
            $compound =$data->compound ? $data->compound->compound_name : '';
            return $compound;
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','compound_id'=>'compound_id','image'=>'image'])->make(true);
    }
}
