<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(){
        $post_views=Post::orderBy('views','DESC')->get();
        $posts=Post::paginate(3);
        return view('blog.index',compact('posts','post_views'));
    }

    public function admin_posts(){
        $posts=Post::paginate(3);
        return view('admin.blog.all',compact('posts'));
    }

    public function create(){
        return view('admin.blog.new');
    }

    public function store(CreatePostRequest $request){
        $fileNewName="m.jpg";
        if($request->hasFile('photo')){
            $fileWithExt=$request->file('photo')->getClientOriginalName();
            $fileWithoutExt=pathinfo($fileWithExt,PATHINFO_FILENAME);
            $fileExt=$request->file('photo')->getClientOriginalExtension();
            $fileNewName=$fileWithoutExt.'_'.time().'.'.$fileExt;
            $path=$request->file('photo')->storeAs('public/blog',$fileNewName);
        }

        Post::create([
            'title'=>$request->title,
            'slug'=>$request->slug,
            'body'=>$request->body,
            'description'=>$request->description,
            'photo'=>$fileNewName,
            'views'=>0,
            'user_id'=>auth()->user()->id
        ]);
        return redirect(route('admin.blog.index'));
    }

    public function create_comment(Request $request){
        $request->validate([
            'comment'=>'required'
        ]);

        Comment::create([
            'post_id'=>$request->post_id,
            'body'=>$request->comment,
            'user_id'=>auth()->user()->id
        ]);
        return back();
    }

    public function show($post){
        $post_views=Post::orderBy('views','DESC')->get();
        $post=Post::find($post);
        return view('blog.show_post',compact('post','post_views'));
    }

    public function edit($id){
        $post=Post::find($id);
        return view('admin.blog.edit',compact('post'));
    }

    public function update(Request $request, $id){
        $post=Post::find($id);
        $fileNewName="m.jpg";
        if($request->hasFile('photo')){
            $fileWithExt=$request->file('photo')->getClientOriginalName();
            $fileWithoutExt=pathinfo($fileWithExt,PATHINFO_FILENAME);
            $fileExt=$request->file('photo')->getClientOriginalExtension();
            $fileNewName=$fileWithoutExt.'_'.time().'.'.$fileExt;
            $path=$request->file('photo')->storeAs('public/blog',$fileNewName);
        }
        $post->update([
            'title'=>$request->title,
            'body'=>$request->body,
            'description'=>$request->description,
            'photo'=>$fileNewName
        ]);
        return redirect(route('admin.blog.index'));
    }

    public function destroy($id){
        Post::find($id)->delete();
        return redirect(route('admin.blog.index'));
    }
}
