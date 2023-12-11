<?php


namespace App\Http\Controllers\Admin;

use App\Models\exchangeOrder;
use App\Models\Piece;
use App\Reposatries\OrderRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\order;
use Yajra\DataTables\DataTables;
use Auth, File;


class OrderController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Order::orderBy('id','desc');
        if(adminInfo()->roleType ==2)
            $data=$data->where('super_id',adminInfo()->id);
        if(adminInfo()->roleType ==3)
            $data=$data->where('technical_id',adminInfo()->id);
        if($request->status)
            $data=$data->where('status',$request->status);
        if($request->type)
            $data=$data->where('type',$request->type);
        if($request->cat_id)
            $data=$data->where('cat_id',$request->cat_id);
        $data=$data->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $piece=Piece::where('quantity','>',0)->get();
        return view('Admin.Order.index',compact('piece'));
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request,OrderRepo $orderRepo)
    {
        $orderRepo->save_Order(new Order,$request,TenantData()->id,1,null);
        return $this->apiResponseMessage(1,trans('basic.addedSuccess'),200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Order = Order::find($id);
        $Order['cat_id']=$Order->cat ?  $Order->cat->name :'';
        $Order['tenant_id']=$Order->tenant ?  $Order->tenant->name :'';
        $Order['super_id']=$Order->super ?  $Order->super->name :'no supervisor yet';
        $Order['technical_id']=$Order->technical ?  $Order->technical->name :'no technical yet';
        return $Order;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request,OrderRepo $orderRepo)
    {
        $Order = Order::find($request->id);
        $orderRepo->save_Order($Order,$request,TenantData()->id,1,null);
        return $this->apiResponseMessage(1,trans('basic.editedSuccess'),200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function assign(Request $request){
        $order=Order::find($request->id);
        $order->status=$request->status;
        $order->technical_id=$request->admin_id;
        $order->save();
        return $this->apiResponseMessage(1,'success',200);
    }
    function confirm_invoice(Request $request){
        $order=Order::find($request->id);
        $order->payment_status= $request->status; 
        $order->save();
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function ChangeStatus(Request $request,$id){
        $order=Order::find($request->id);
        $order->status=$request->status;
        $order->save();
        return $this->apiResponseMessage(1,'success',200);
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
            $Order = Order::whereIn('id', $ids)->get();
            foreach($Order as $row){
                $this->deleteRow($row);
            }
        } else {
            $Order = Order::find($id);
            $this->deleteRow($Order);
        }
        return response()->json(['errors' => false,'msg'=>trans('basic.deleteSuccess')]);
    }

    /**
     * @param $Order
     */
    private function deleteRow($Order){
        $Order->delete();
    }

    /***
     * @param Request $request
     * @param OrderRepo $orderRepo
     * @return \Illuminate\Http\JsonResponse
     */
    public function save_piece(Request $request,OrderRepo $orderRepo){
        $order=Order::find($request->order_id);
        $orderRepo->save_piece($request->piece_id,$request->order_id,$request,$order->super_id,new exchangeOrder(),3);
        return response()->json(['status' => 1,'message'=>trans('admins.waitPerm')]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $order=Order::find($id);
        return view('Admin.Order.profile.profile',compact('order'));
    }
    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    private function mainFunction($data)
    {
        return Datatables::of($data)->addColumn('action', function ($data) {
            $options = ' <button  class="btn btn-info waves-effect btn-circle waves-light" onclick="showFunction(' . $data->id . ')" type="button" ><i class="fa fa-spinner fa-spin" id="loadShow_' . $data->id . '" style="display:none"></i><i class="icon-Eye-Blind"></i></button>';
            if(adminInfo()->roleType ==1)
                $options .= ' <button type="button" onclick="deleteFunction(' . $data->id . ',1)" class="btn btn-dribbble waves-effect btn-circle waves-light"><i class="sl-icon-trash"></i> </button></td>';
            if(in_array(adminInfo()->roleType,[1,2]))
                $options .= ' <td class="sorting_1"><button  class="btn btn-success waves-effect btn-circle waves-light" title="'.getChangeStatusTitle().'" onclick="assignFunction(' . $data->id . ')" type="button" ><i class="icon-Lock-User"></i></button>';
                $options .= ' <td class="sorting_1"><a  class="btn btn-secondary waves-effect btn-circle waves-light" target="_blank" title="'.trans('admins.Pieces_orders2').'" href="/Admin/exchangeOrder/index?order_id='.$data->id.'" type="button" ><i class="icon-Data-Cloud"></i></a>';
            if(adminInfo()->roleType ==3 AND $data->status ==3)
                $options .= ' <button type="button" onclick="orderStatusFunction(' . $data->id . ',4)" class="btn btn-success waves-effect btn-circle waves-light" title="'.trans('admins.makeOrderProg').'"><i class="icon-Security-Check"></i> </button></td>';
            if(adminInfo()->roleType ==3 AND $data->status ==4)
                $options .= ' <button type="button" onclick="orderStatusFunction(' . $data->id . ',5)" class="btn btn-success waves-effect btn-circle waves-light" title="'.trans('admins.makeOrderCom').'"><i class="fas fa-check-circle"></i> </button></td>';
            if(adminInfo()->roleType ==3 AND $data->status ==4)
                $options .= ' <button type="button" onclick="ExchangeFunc('.$data->id .')" class="btn btn-danger waves-effect btn-circle waves-light" title="'.trans('admins.Pieces_orders').'"><i class="icon-Security-Check"></i> </button></td>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->editColumn('image', function ($data) {
            $image = '<a href="'. getImageUrl('Order',$data->image).'" target="_blank">'
                .'<img  src="'. getImageUrl('Order',$data->image) . '" width="50px" height="50px"></a>';
            return $image;
        })->editColumn('cat_id', function ($data) {
            return $data->cat ? $data->cat->name : '';
        })->editColumn('technical_id', function ($data) {
            return $data->technical ? $data->technical->name : trans('admins.noTechnical');
        })->editColumn('type', function ($data) {
            return getMaintenanceType($data->type);
        })->editColumn('status', function ($data) {
            $array=getStatusAndBtn($data->status,1);
            $status = '<button class="btn waves-effect waves-light btn-rounded btn-'.$array[0].' statusBut" >'.$array[1].'</button>';
            return $status;
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','image'=>'image','status'=>'status'])->make(true);
    }
}

