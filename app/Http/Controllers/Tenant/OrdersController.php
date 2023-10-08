<?php


namespace App\Http\Controllers\Tenant;

use App\Reposatries\OrderRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Yajra\DataTables\DataTables;
use Auth, File;


class OrdersController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Order::orderBy('id','desc')->where('tenant_id',TenantData()->id);
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
        return view('Tenant.Order.index');
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
    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    private function mainFunction($data)
    {
        return Datatables::of($data)->addColumn('action', function ($data) {
            $options = ' <button type="button" onclick="deleteFunction(' . $data->id . ',1)" class="btn btn-dribbble waves-effect btn-circle waves-light"><i class="sl-icon-trash"></i> </button></td>';
            if($data->status == 1)
                $options .= '<td class="sorting_1"><button  class="btn btn-info waves-effect btn-circle waves-light" onclick="editFunction(' . $data->id . ')" type="button" ><i class="fa fa-spinner fa-spin" id="loadEdit_' . $data->id . '" style="display:none"></i><i class="sl-icon-wrench"></i></button>';
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
        })->editColumn('type', function ($data) {
            return getMaintenanceType($data->type);
        })->editColumn('status', function ($data) {
            $array=getStatusAndBtn($data->status,1);
            $status = '<button class="btn waves-effect waves-light btn-rounded btn-'.$array[0].' statusBut" >'.$array[1].'</button>';
            return $status;
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','image'=>'image','status'=>'status'])->make(true);
    }
}

