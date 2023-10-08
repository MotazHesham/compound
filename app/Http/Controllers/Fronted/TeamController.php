<?php

namespace App\Http\Controllers\Fronted;

use App\Interfaces\UserInterface;
use App\Models\Team;
use App\Models\TeamWork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Artisan,Hash,File,Crypt;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Manage\EmailsController;

class TeamController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Team (){
        return view('Fronted.Team.allTeam');
    }

    public function singleTeam (Request $request){
        $team=Team::find($request->team_id);
        if(is_null($team)){
            return view('404');
        }
        return view('Fronted.Team.singleTeam',compact('team'));
    }

    public function teamWork (Request $request){
        $media=TeamWork::where('team_id',$request->team_id)->paginate(36);
        $team=Team::find($request->team_id);
        $title=$team->name;
        $folder='Work';
        return view('Fronted.GeneralPages.media',compact('media','title','folder'));

    }
}
