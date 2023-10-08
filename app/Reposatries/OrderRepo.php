<?php

namespace App\Reposatries;

use App\Models\User;
use Illuminate\Http\Request;
use Validator, Auth, Artisan, Hash, File, Crypt;

class OrderRepo
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param $order
     * @param $request
     * @param $tenant_id
     * @param $status
     * @param $super_id
     */
    public function save_Order($order,$request,$tenant_id,$status,$super_id){
        $order->content=$request->content;
        $order->type=$request->type;
        if($request->image){
            deleteFile('Order',$order->image);
            $order->image = $request->image;
        }
        if($status)
            $order->status=$status;
        $order->tenant_id=$tenant_id;
        $order->super_id=$super_id;
        $order->technical_id=$request->technical_id;
        $order->cat_id=$request->cat_id;
        $order->price=$request->price;
        $order->suggestDate=$request->suggestDate;
        $order->date=$request->date;
        $order->save();
    }

    /**
     * @param $exchange_orders_id
     * @param $order_id
     * @param $request
     * @param $admin_id
     * @param $exchange_orders
     * @param $status
     * @return int
     */
    public function save_piece($piece_id,$order_id,$request,$admin_id,$exchange_orders,$status){
        $exchange_orders->admin_id=$admin_id;
        $exchange_orders->order_id=$order_id;
        $exchange_orders->piece_id=$piece_id;
        $exchange_orders->quantity=$request->quantity;
        $exchange_orders->status=$status;
        $exchange_orders->type=$request->type;
        $exchange_orders->save();
        return 1;

    }
}
