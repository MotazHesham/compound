<?php

namespace App\Http\Controllers\Api\Technical;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAuthApiController extends Controller
{
    use api_return;  

    public function logout(Request $request){ 
        $request->user()->currentAccessToken()->delete();
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    } 

    public function login(Request $request){

        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        if (Auth::guard('Admin')->attempt(['email' => $request->email, 'password' => $request->password])) { 
            $token = Auth::guard('Admin')->user()->createToken('user_token')->plainTextToken;  
            return $this->returnData(
                [
                    'user_token' => $token,
                    'user_type' => 'technical',
                    'user_id '=> Auth::guard('Admin')->id(), 
                ]
            ); 
        }elseif (Auth::guard('Tenant')->attempt(['email' => $request->email, 'password' => $request->password])) { 
            $token = Auth::guard('Tenant')->user()->createToken('user_token')->plainTextToken;  
            return $this->returnData(
                [
                    'user_token' => $token,
                    'user_type' => 'tenant',
                    'user_id '=> Auth::guard('Tenant')->id(), 
                ]
            ); 
        } else {
            return $this->returnError('500',trans('global.flash.api.invalid_user_or_password'));
        }
    }

    public function login_via_phone(Request $request){

        $rules = [
            'phone' => 'required', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        } 

        $tenant = Tenant::where('phone',$request->phone)->first();
        if ($tenant) {  
            $token  = $tenant->createToken(uniqid());
            return $this->returnData(
                [
                    'user_token' => $token->plainTextToken,
                    'user_type' => 'technical',
                    'user_id '=> $tenant->id, 
                ]
            ); 
        } else {
            return $this->returnError('500',trans('global.flash.api.invalid_user_or_password'));
        }
    }
}
