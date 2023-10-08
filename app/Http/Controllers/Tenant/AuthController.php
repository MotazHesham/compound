<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class AuthController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('Tenant.dashboard');
    }

    /**
     * @param Request $request
     * @return int
     */
    public function login(Request $request)
    {
        $credentials = [
            'id_number' => $request['id_number'],
            'password' => '',
        ];
        $Tenant=Tenant::where('id_number',$request->id_number)->first();

        if (is_null($Tenant)) {
                return 3;
        }
        Auth::guard('Tenant')->login($Tenant);
        return 1;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::guard('Tenant')->logout();
        return redirect('/Tenant/login');
    }
}
