<?php


namespace App\Http\Controllers\Admin;

use App\Models\Bus;
use App\Models\Category;
use App\Models\Villas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Party;
use App\Models\Compound;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class PartyController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Party::orderBy('id','desc');
        $data=$data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $bus = Bus::get();
        return view('Admin.Party.index',compact('bus'));
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {

        $this->save_Party($request,new Party,0);
        return $this->apiResponseMessage(1,trans('basic.addedSuccess'),200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Party = Party::find($id);
        return $Party;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $Party = Party::find($request->id);
        $this->save_Party($request,$Party,null);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param $request
     * @param $Party
     * @param $quantity
     */
    public function save_Party($request,$Party,$quantity){
        $Party->date=$request->date;
        $Party->desc=$request->desc;
        $Party->bus_id=$request->bus_id;
        $Party->to=$request->to;
        $Party->from=$request->from;
        $Party->capacity=$request->capacity;
        $Party->NumSubscribers=$request->capacity;
        $Party->save();
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
            $Party = Party::whereIn('id', $ids)->get();
            foreach($Party as $row){
                $this->deleteRow($row);
            }
        } else {
            $Party = Party::find($id);
            $this->deleteRow($Party);
        }
        return response()->json(['errors' => false,'msg'=>trans('basic.deleteSuccess')]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $party =Party::find($id);
        return view('Admin.Party.show',compact('party'));
    }
    /**
     * @param $Party
     */
    private function deleteRow($Party){
        deleteFile('Party',$Party->image);
        $Party->delete();
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
            $options .= ' <a title="'.trans("basic.details").'" href="'.route("Party.show",$data->id).'" target="_blank"  class="btn btn-success waves-effect btn-circle waves-light"><i class="icon-Eye"></i> </a></td>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->editColumn('bus_id', function ($data) {
           return $data->bus ? $data->bus->name : '';
        })->editColumn('NumSubscribers', function ($data) {
            return $data->tenants->count();
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','image'=>'image'])->make(true);
    }
}
