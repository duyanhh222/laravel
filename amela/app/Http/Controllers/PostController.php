<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('post.index',compact('posts'));
    }
    public function create()
    {
        return view('post.create');
    }
    public function store(Request $request)
    {
        $request->validate([
                'title' => 'required|unique:post',
                'content' => 'required|max:255',
                'category_id' => 'required',
                'created_at' => 'required',
                'updated_at' => 'required'
            ],
            [
                'title.required' =>'ten tieu de ko dc bo trong',
                'title.unique' => 'ten tieu de ko dc trung',
                'content.required' => 'noi dung ko dc bo trong',
                'content.max' =>'noi dung ko dc dai qua 255'

            ]);
           
            Post::insert($request->only( 'title','category_id','content','created_at','updated_at'));
            return redirect()->route('post.index')->with('success','them thanh cong');
    }
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|unique:post,title,'.$post->id,
            'content' => 'required|max:255',
            'category_id' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required'
        ],
        [
            'title.required' =>'ten tieu de ko dc bo trong',
            'title.unique' => 'ten tieu de ko dc trung',
            'content.required' => 'noi dung ko dc bo trong',
            'content.max' =>'noi dung ko dc dai qua 255'

        ]);
       
        $post->update($request->only( 'title','category_id','content','created_at','updated_at'));
        return redirect()->route('post.index')->with('success','sua thanh cong');
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('success','xoa thanh cong');
    }
}
