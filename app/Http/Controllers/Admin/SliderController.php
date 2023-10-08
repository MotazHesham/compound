<?php


namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Villas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Compound;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Slider::orderBy('id','desc');
        $data=$data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    { 
        return view('Admin.Slider.index');
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {

        $this->save_Slider($request,new Slider,0);
        return $this->apiResponseMessage(1,trans('basic.addedSuccess'),200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Slider = Slider::find($id);
        return $Slider;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $Slider = Slider::find($request->id);
        $this->save_Slider($request,$Slider,null);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param $request
     * @param $Slider
     * @param $quantity
     */
    public function save_Slider($request,$Slider,$quantity){
        $Slider->text=$request->text;
        $Slider->type=$request->type; 
        if($request->image){
            deleteFile('Slider',$Slider->image);
            $Slider->image=saveImage('Slider',$request->image);
        }
        $Slider->save();
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
            $Slider = Slider::whereIn('id', $ids)->get();
            foreach($Slider as $row){
                $this->deleteRow($row);
            }
        } else {
            $Slider = Slider::find($id);
            $this->deleteRow($Slider);
        }
        return response()->json(['errors' => false,'msg'=>trans('basic.deleteSuccess')]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $slider=Slider::find($id);
        $vills=Villas::get();
        return view('Admin.Slider.profile.profile',compact('slider','vills'));
    }
    /**
     * @param $Slider
     */
    private function deleteRow($Slider){
        deleteFile('Slider',$Slider->image);
        $Slider->delete();
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
            $image = '<a href="'. getImageUrl('Slider',$data->image).'" target="_blank">'
                .'<img  src="'. getImageUrl('Slider',$data->image) . '" width="50px" height="50px"></a>';
            return $image;
        })->editColumn('type', function ($data) {
            return $data->type ? $data->type : '';
        })->editColumn('text', function ($data) {
            return $data->text ? $data->text : '';
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','image'=>'image'])->make(true);
    }
}
