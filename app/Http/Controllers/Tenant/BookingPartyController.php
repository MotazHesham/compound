<?php


namespace App\Http\Controllers\Tenant;

use App\Models\Party;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PartyBooking;
use Yajra\DataTables\DataTables;
use Auth, File;


class BookingPartyController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = PartyBooking::orderBy('id','desc')->where('tenant_id',TenantData()->id);
        $data=$data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Tenant.BookingParty.index');
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $book=PartyBooking::where('tenant_id',TenantData()->id)->where('party_id',$request->party_id)->first();
        if(!is_null($book)){
            $msg=getLang() =='ar' ? 'لقد ححزت هذه الحافلة من قبل' : 'you already booked this bus';
            return response()->json(['status'=>0,'message'=>$msg,'icon'=>'error']);
        }
        $book=Party::whereDate('date','>',now())->where('id',$request->party_id)->first();
        if(is_null($book)){
            $msg=getLang() =='ar' ? 'لا يمكن الحجز' : 'cannot booking';
            return response()->json(['status'=>0,'message'=>$msg,'icon'=>'error']);
        }
        if($request->numbers > $book->NumSubscribers){
            $msg=getLang() =='ar' ? $book->NumSubscribers.'العدد المتاح للحجز هو ' : 'The number available for reservation is ' . $book->NumSubscribers;
            return response()->json(['status'=>0,'message'=>$msg,'icon'=>'error']);
        }
        $book->NumSubscribers -=$request->numbers;
        $book->save();
        $this->save_PartyBooking(new PartyBooking,$request,1);
        return response()->json(['status'=>1,'message'=>trans('basic.addedSuccess'),'icon'=>'success']);
    }


    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $PartyBooking = PartyBooking::find($request->id);
        $this->save_PartyBooking($PartyBooking,$request);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param $book
     * @param $request
     */
    private function save_PartyBooking($book,$request,$status){
        $book->numbers=$request->numbers;
        $book->party_id=$request->party_id;
        $book->status=$status;
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
            $PartyBooking = PartyBooking::whereIn('id', $ids)->get();
            foreach($PartyBooking as $row){
                $party=Party::find($row->$id);
                $party->NumSubscribers += $row->numbers;
                $party->save();
                $this->deleteRow($row);
            }
        } else {
            $PartyBooking = PartyBooking::find($id);
            $party=Party::find($PartyBooking->party_id);
            $party->NumSubscribers += $PartyBooking->numbers;
            $party->save();
            $this->deleteRow($PartyBooking);
        }
        return response()->json(['errors' => false,'msg'=>trans('basic.deleteSuccess')]);
    }

    /**
     * @param $PartyBooking
     */
    private function deleteRow($PartyBooking){
        $PartyBooking->delete();
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
        })->editColumn('party_id', function ($data) {
            return $data->party ? '<a target="_blank" href="/Tenant/PartyT/show/'.$data->party_id.'">'.$data->party->bus->name.'</a>' : '';
        })->editColumn('status', function ($data) {
            $array=getBookingStatusAndBtn($data->status);
            $status = '<button class="btn waves-effect waves-light btn-rounded btn-'.$array[0].' statusBut" >'.$array[1].'</button>';
            return $status;
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','party_id'=>'party_id','status'=>'status'])->make(true);
    }
}

