<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Category::where('type',$request->type)->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $type=$request->type;
        return view('Admin.Category.index',compact('type'));
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {

        $this->save_Category($request,new Category);
        return $this->apiResponseMessage(1,trans('basic.addedSuccess'),200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Category = Category::find($id);
        return $Category;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {

        $Category = Category::find($request->id);
        $this->save_Category($request,$Category);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param $request
     * @param $Category
     */
    public function save_Category($request,$Category){
        $Category->name=$request->name;
        $Category->type=$request->type;
        if($request->image){
            deleteFile('Category',$Category->image);
            $Category->image=saveImage('Category',$request->image);
        }
        $Category->save();
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
            $Category = Category::whereIn('id', $ids)->get();
            foreach($Category as $row){
                $this->deleteRow($row);
            }
        } else {
            $Category = Category::find($id);
            $this->deleteRow($Category);
        }
        return response()->json(['errors' => false,'msg'=>trans('basic.deleteSuccess')]);
    }

    /**
     * @param $Category
     */
    private function deleteRow($Category){
        $Category->delete();
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
            $image = '<a href="'. getImageUrl('Category',$data->image).'" target="_blank">'
                .'<img  src="'. getImageUrl('Category',$data->image) . '" width="50px" height="50px"></a>';
            return $image;
        })->rawColumns(['action' => 'action','image' => 'image','checkBox'=>'checkBox','class'=>'class'])->make(true);
    }
}
