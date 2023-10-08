<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Rate;
use Illuminate\Http\Request;
use App\Traits\api_return;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestsApiController extends Controller
{
    use api_return;    

    public function upcoming(){  
        $orders = order::with('rate')->where('tenant_id',Auth::id())->whereIn('status',[1,2,3,4])->orderBy('updated_at','desc')->paginate(15);
        $resource = OrderResource::collection($orders);  
        return $this->returnPaginationData($resource,$orders,'success'); 
    } 

    public function completed(){  
        $orders = order::with('rate')->where('tenant_id',Auth::id())->where('status',5)->orderBy('updated_at','desc')->paginate(15);
        $resource = OrderResource::collection($orders);  
        return $this->returnPaginationData($resource,$orders,'success'); 
    } 

    public function closed(){  
        $orders = order::with('rate')->where('tenant_id',Auth::id())->where('status',6)->orderBy('updated_at','desc')->paginate(15);
        $resource = OrderResource::collection($orders);  
        return $this->returnPaginationData($resource,$orders,'success'); 
    } 

    public function available_times(Request $request){
        
        $rules = [    
            'date' => 'required|date_format:Y-m-d', 
            'service_id' => 'integer|required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        } 

        $reserved_times = Order::where('suggestDate',$request->date)->where('cat_id',$request->service_id)->whereNotNull('time')->get()->pluck('time')->toArray();

        $times = [];
        foreach(Order::TIMES_SELECT as $key => $entry){
            $tmp = [];
            $tmp['text'] = $entry;
            $tmp['time'] = $key;
            if(in_array($key,$reserved_times)){
                $tmp['available'] = false;
            }else{
                $tmp['available'] = true;
            }
            $times[] = $tmp;
        }
        return $this->returnData($times);
    }

    public function rate(Request $request){
        
        $rules = [     
            'request_id' => 'integer|required',
            'review' => 'string|required',
            'rate' => 'in:1,2,3,4,5|required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        } 
        $order = Order::find($request->request_id);
        if(!$order){
            return $this->returnError('500','not found');
        }
        $rate = new Rate();
        $rate->order_id = $request->request_id;
        $rate->review = $request->review;
        $rate->rate = $request->rate;
        $rate->save();
        
        $order->status = 6;
        $order->save();
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
    public function add(Request $request){
        
        $rules = [   
            'service_id' => 'integer|required',
            'type'=> 'required|in:1,2', 
            'content'=> 'string|required',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|in:'. implode(',',array_keys(Order::TIMES_SELECT)), 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        } 
        
        if(Order::where('suggestDate',$request->date)->where('cat_id',$request->service_id)->where('time',$request->time)->first()){ 
            return $this->returnError('500','هذا الوقت غير متاح , اختر معاد أخر');
        }

        $order = order::create([ 
            'tenant_id' => Auth::id(),
            'cat_id' => $request->service_id,
            'content' => $request->content,  
            'suggestDate' => $request->date,  
            'time' => $request->time,  
            'type' => $request->type,   
            'status' => 1,
        ]);    
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
}
