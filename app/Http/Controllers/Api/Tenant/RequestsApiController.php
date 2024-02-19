<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tenant\OrderResource;
use App\Models\Admin;
use App\Models\exchangeOrder;
use App\Models\order;
use App\Models\Rate;
use App\Models\TechnicalRate;
use Illuminate\Http\Request;
use App\Traits\api_return;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestsApiController extends Controller
{
    use api_return;    

    public function get_token(Request $request){
        
        $rules = [    
            'request_id' => 'required|integer', 
            'email' => 'email|required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        } 

        $order = Order::find($request->request_id);
        $six_digit_random_number = random_int(100000, 999999);
        $order->token = $six_digit_random_number;
        $order->token_created_date = date('Y-m-d H:i:s');
        $order->save();
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }

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

    public function rate_technical(Request $request){
        
        $rules = [   
            'technical_id' => 'integer|required',
            'order_id' => 'integer|required',
            'rate'=> 'integer|required|in:1,2,3,4,5', 
            'review'=> 'required', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  
        
        if(!order::where('tenant_id',Auth::id())->first() || !Admin::where('id',$request->technical_id)->first()){
            return $this->returnError('500','خطأ في البيانات');
        }
        if(TechnicalRate::where('tenant_id',Auth::id())->where('order_id',$request->order_id)->first()){
            return $this->returnError('500','لقد قمت بتقييمه من قبل');
        }
        $rateTechnical = new TechnicalRate();
        $rateTechnical->technical_id = $request->technical_id;
        $rateTechnical->order_id = $request->order_id;
        $rateTechnical->rate = $request->rate;
        $rateTechnical->review = $request->review;
        $rateTechnical->tenant_id = Auth::id();
        $rateTechnical->save();

        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
    
    
    public function add_invoice(Request $request){
        
        $rules = [   
            'request_id' => 'integer|required',
            'bank_name'=> 'required',  
            'date'=> 'required',  
            'amount'=> 'required',  
            'image'=> 'required',  
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  


        $order = Order::find($request->request_id); 
        if($order->payment_status != 'paid'){
            $order->inv_image = $request->image->store('public/order/invoice_image');  
            $order->inv_bank_name = $request->bank_name; 
            $order->inv_amount = $request->amount; 
            $order->inv_date = $request->date; 
            $order->payment_status = 'review_payment';
            $order->save();   
        }
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
}
