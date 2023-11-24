<?php

namespace App\Http\Controllers\Api\Technical;

use App\Http\Controllers\Controller;
use App\Http\Resources\Technical\OrderResource;
use App\Http\Resources\Technical\PieceResource;
use App\Models\exchangeOrder;
use App\Models\order;
use App\Models\Piece;
use App\Models\Rate;
use Illuminate\Http\Request;
use App\Traits\api_return;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestsApiController extends Controller
{
    use api_return;    

    public function pieces(){
        $pieces = Piece::all();
        $resource = PieceResource::collection($pieces);  
        return $this->returnData($resource,'success');
    }

    public function requests(){  
        $orders = order::with(['tenant.villa.compound','exchangeOrders.Piece'])->where('technical_id',Auth::id())->whereIn('status',[1,2,3,4])->orderBy('updated_at','desc')->paginate(15);
        $resource = OrderResource::collection($orders);  
        return $this->returnPaginationData($resource,$orders,'success'); 
    }  

    public function closed(){  
        $orders = order::with(['tenant.villa.compound','exchangeOrders.Piece'])->where('technical_id',Auth::id())->whereIn('status',[5,6])->orderBy('updated_at','desc')->paginate(15);
        $resource = OrderResource::collection($orders);  
        return $this->returnPaginationData($resource,$orders,'success'); 
    }  

    
    public function add_part(Request $request){
        
        $rules = [   
            'request_id' => 'integer|required',
            'part_from'=> 'required|in:warehouse,client', 
            'piece_id'=> 'integer|required',
            'quantity' => 'required|integer',
            'type' => 'required|in:1,2', // 1 => new  /// 2 => old
            'description' => 'nullable',
            'images' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        } 
        $images = [];
        if($request->has('images')){ 
            foreach ($request->images as $key => $image) { 
                $images[] = $image->store('public/parts/images');   
            }
        }

        $exchangeOrder = new exchangeOrder;

        $exchangeOrder->order_id = $request->request_id;
        $exchangeOrder->piece_id = $request->piece_id;
        $exchangeOrder->quantity = $request->quantity;  
        $exchangeOrder->type = $request->type;  
        $exchangeOrder->part_from = $request->part_from;  
        $exchangeOrder->description = $request->description;  
        $exchangeOrder->images = json_encode($images);   
        $exchangeOrder->status = 3;
        $exchangeOrder->save();   
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
    
    public function status(Request $request){
        
        $rules = [   
            'request_id' => 'integer|required',
            'status'=> 'required|in:4,5',  
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  


        $order = order::find($request->request_id);
        $images = [];
        if($request->has('images')){ 
            foreach ($request->images as $key => $image) { 
                $images[] = $image->store('public/order/issue_images');   
            }
        }
        $order->status = $request->status;
        $order->issue_description = $request->issue_description;
        $order->images = $images;
        $order->save();   
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
    
    public function add_invoice(Request $request){
        
        $rules = [   
            'part_id' => 'integer|required',
            'bank_name'=> 'required',  
            'date'=> 'required',  
            'amount'=> 'required',  
            'image'=> 'required',  
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  


        $exchangeOrder = exchangeOrder::find($request->part_id); 
        $exchangeOrder->inv_image = $request->image->store('public/exchangeOrder/invoice_image');  
        $exchangeOrder->inv_bank_name = $request->bank_name; 
        $exchangeOrder->inv_amount = $request->amount; 
        $exchangeOrder->inv_date = $request->date; 
        $exchangeOrder->save();   
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
}
