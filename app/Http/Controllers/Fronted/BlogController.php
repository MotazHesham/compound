<?php

namespace App\Http\Controllers\Fronted;

use App\Interfaces\UserInterface;
use App\Models\Blog;
use App\Models\BlogCat;
use App\Models\BlogComment;
use App\Models\BlogWork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Artisan,Hash,File,Crypt;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Controllers\Manage\EmailsController;

class BlogController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blogsByCat (Request $request){
        $blogs=Blog::where('cat_id',$request->cat_id)->where('status',1)->orderBy('id','desc')->paginate(24);
        $title=BlogCat::where('id',$request->cat_id)->value('name');
        return view('Fronted.Blog.allBlog',compact('title','blogs'));
    }

    public function search(Request $request){
        $blogs=Blog::where('title','LIKE','%' . $request->searchText . '%')->where('status',1)->orderBy('id','desc')->paginate(24);
        $title='نتائج البحث';
        return view('Fronted.Blog.allBlog',compact('title','blogs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function allBlog(){
        $blogs=Blog::where('status',1)->orderBy('id','desc')->paginate(24);
        $title='المدونة';
        return view('Fronted.Blog.allBlog',compact('title','blogs'));

    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function singleBlog  (Request $request){
        $blog=Blog::find($request->blog_id);
        if(is_null($blog)){
            return view('404');
        }
        return view('Fronted.Blog.singleBlog',compact('blog'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function BlogWork (Request $request){
        $media=BlogWork::where('Blog_id',$request->Blog_id)->paginate(36);
        $Blog=Blog::find($request->Blog_id);
        $title=$Blog->name;
        $folder='Work';
        return view('Fronted.GeneralPages.media',compact('media','title','folder'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveComment(Request $request,$id){
        $blogComment=new BlogComment;
        $blogComment->blog_id=$id;
        $blogComment->name=$request->name;
        $blogComment->phone=$request->phone;
        $blogComment->email=$request->email;
        $blogComment->comment=$request->comment;
        $blogComment->save();
        return response()->json(['status'=>1,'message'=>'تم حفظ تعليقك بنجاح']);
    }
}
