<?php


namespace App\Http\Controllers\Tenant;

use App\Reposatries\PartyRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Party;
use Yajra\DataTables\DataTables;
use Auth, File;


class PartyController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Tenant.Party.calender');
    }

    /**
     * @return mixed
     */
    public function allData(){
        return getParty();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function calender (){
        return view('Tenant.Party.calender');

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show ($id){
        $party=Party::find($id);
        return view('Tenant.Party.show',compact('party'));
    }


}

