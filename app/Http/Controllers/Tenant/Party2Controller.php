<?php


namespace App\Http\Controllers\Tenant;

use App\Models\PartyType;
use App\Reposatries\Party2Repo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Party2;
use Yajra\DataTables\DataTables;
use Auth, File;


class Party2Controller extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Party2::orderBy('id','desc')->where('tenant_id',TenantData()->id);
        $data=$data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $types=PartyType::all();
        return view('Tenant.Party2.index',compact('types'));
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $book=Party2::whereDate('date',$request->date)->first();
        if(!is_null($book)){
            $msg=getLang() =='ar' ? 'لا يمكن الحجز في هذا اليوم' : 'cannot book on this day';
            return response()->json(['status'=>0,'message'=>$msg,'icon'=>'error']);
        }
        $book=Party2::where('tenant_id',TenantData()->id)->where('status',1)->count();
        if($book > 0){
            $msg=getLang() =='ar' ? 'لا يمكن حجز حفلتين في توقيت واحد' : 'cannot book tow party in the same time';
            return response()->json(['status'=>0,'message'=>$msg,'icon'=>'error']);
        }
        $this->save_Party2(new Party2,$request,1);
        return response()->json(['status'=>1,'message'=>trans('basic.addedSuccess'),'icon'=>'success']);
    }


    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $Party2 = Party2::find($request->id);
        $this->save_Party2($Party2,$request);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param $book
     * @param $request
     */
    private function save_Party2($book,$request,$status){
        $book->type_id=$request->type_id;
        $book->status=$status;
        $book->date=$request->date;
        $book->time=$request->time;
        $book->tenant_id=TenantData()->id;
        $book->save();
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
     * @param $Party2
     */
    private function deleteRow($Party2){
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
            $options = ' <button type="button" onclick="deleteFunction(' . $data->id . ',1)" class="btn btn-dribbble waves-effect btn-circle waves-light"><i class="sl-icon-trash"></i> </button></td>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->editColumn('status', function ($data) {
            $array=getBookingStatusAndBtn($data->status);
            $status = '<button class="btn waves-effect waves-light btn-rounded btn-'.$array[0].' statusBut" >'.$array[1].'</button>';
            return $status;
        })->editColumn('type', function ($data) {
            return $data->type ? getLang()=='ar' ? $data->type->name_ar : $data->type->name_en : null;
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','party_id'=>'party_id','status'=>'status'])->make(true);
    }
}

