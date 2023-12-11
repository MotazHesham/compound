<?php

namespace App\Http\Controllers\Api\Technical;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tenant\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\api_return;  

class ServiceApiController extends Controller
{
    use api_return;    

    public function services(Request $request){ 

        $categories = Category::get();
        
        return $this->returnData(CategoryResource::collection($categories)); 
    }  
}
