<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tenant\CategoryResource;
use App\Http\Resources\Tenant\OrderResource;
use App\Http\Resources\Tenant\SliderResource;
use App\Models\Category;
use App\Models\order;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\api_return;
use Illuminate\Support\Facades\Auth;

class HomeApiController extends Controller
{
    use api_return;    

    public function sliders(Request $request){

        $sliders = Slider::where('type','application')->get();
        
        return $this->returnData(SliderResource::collection($sliders)); 
    } 

    public function services(Request $request){

        $categories = Category::orderBy('updated_at','desc')->take(3)->get();
        
        return $this->returnData(CategoryResource::collection($categories)); 
    } 

    public function requests(Request $request){

        $orders = Order::where('tenant_id',Auth::id())->orderBy('updated_at','desc')->take(4)->get();
        
        return $this->returnData(OrderResource::collection($orders)); 
    } 
}
