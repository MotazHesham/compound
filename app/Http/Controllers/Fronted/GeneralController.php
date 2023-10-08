<?php

namespace App\Http\Controllers\Fronted;

use App\Interfaces\UserInterface;
use App\Models\Contact;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Artisan,Hash,File,Crypt;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Manage\EmailsController;

class GeneralController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function media (){
        $media=Media::where('status',1)->where('image','!=',null)->paginate(36);
        $title='المركز الاعلامي';
        $folder='Compounds';
        return view('Fronted.GeneralPages.media',compact('media','title','folder'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function volunteer(){
        return view('Fronted.GeneralPages.volunteer');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact_us(){
        return view('Fronted.GeneralPages.contact_us');
    }

    public function about_us(){
        return view('Fronted.GeneralPages.about_us');

    }

    public function Reports(){
        return view('Fronted.GeneralPages.Reports');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveContactUs(Request $request){
        $contact=new Contact();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->message=$request->message;
        $contact->save();
        return response()->json(['status'=>1,'message'=>'تم ارسال رسالتك وسيقوم فريقنا بالتواصل معك']);
    }

}
