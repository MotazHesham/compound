<?php

namespace App\Http\Controllers\Fronted;

use App\Interfaces\UserInterface;
use App\Models\Subscribe;
use App\Models\Team;
use App\Models\TeamWork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Artisan,Hash,File,Crypt;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Manage\EmailsController;

class SubscribeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Active  (){
        $title='تسجيل عضو عامل';
        $type=1;
        $price='رسوم العضو العامل: (300) ريال فأكثر سنوياً';
        return view('Fronted.Subscribe.Subscribe',compact('title','type','price'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Associate (){
        $title='تسجيل عضو منتسب';
        $type=2;
        $price='رسوم العضو المنتسب: (100) ريال فأكثر سنوياً';
        return view('Fronted.Subscribe.Subscribe',compact('title','type','price'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveSubscribe(Request $request){
        $Subscribe=new Subscribe();
        $Subscribe->name=$request->name;
        $Subscribe->email=$request->email;
        $Subscribe->age=$request->age;
        $Subscribe->phone=$request->phone;
        $Subscribe->type=$request->type;
        $Subscribe->qualification=$request->qualification;
        $Subscribe->nationality=$request->nationality;
        $Subscribe->id_number=$request->id_number;
        $Subscribe->job=$request->job;
        $Subscribe->status=2;
        $Subscribe->save();
        return response()->json(['status'=>1,'message'=>'تم تسجيل العضوية وسيقوم فريقنا بالتواصل معك']);
    }


}
