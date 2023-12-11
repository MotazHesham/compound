<?php

namespace App\Http\Controllers\Api\Tenant;

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

    public function register(Request $request){

        $rules = [ 
            'name' => 'string|required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20', 
            'phone_number' => 'required|size:11|regex:/(01)[0-9]{9}/',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number, 
            'user_type' => 'customer',
        ]);   
        $token = $user->createToken('user_token')->plainTextToken; 
        return $this->returnData(
            [
                'user_token' => $token,
                'user_type' => 'tenant',
                'user_id '=> $user->id, 
            ]
        );

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

        if (Auth::guard('Tenant')->attempt(['email' => $request->email, 'password' => $request->password])) { 
            $token = Auth::guard('Tenant')->user()->createToken('user_token')->plainTextToken;  
            return $this->returnData(
                [
                    'user_token' => $token,
                    'user_type' => 'tenant',
                    'user_id '=> Auth::guard('Tenant')->id(), 
                ]
            ); 
        } elseif (Auth::guard('Admin')->attempt(['email' => $request->email, 'password' => $request->password])) { 
            $token = Auth::guard('Admin')->user()->createToken('user_token')->plainTextToken;  
            return $this->returnData(
                [
                    'user_token' => $token,
                    'user_type' => 'technical',
                    'user_id '=> Auth::guard('Admin')->id(), 
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
                    'user_type' => 'tenant',
                    'user_id '=> $tenant->id, 
                ]
            ); 
        } else {
            return $this->returnError('500',trans('global.flash.api.invalid_user_or_password'));
        }
    }
}
