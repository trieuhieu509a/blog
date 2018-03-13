<?php

namespace App\Http\Controllers;

use App\Post;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_active', 1)->orderBy('created_at', 'desc')->paginate(2);
        return view('blog.index', ['posts' => $posts]);
    }

    public function post($id)
    {
        $post = Post::where('id', $id)->first();
        return view('blog.post', ['post' => $post]);
    }

    public function adminIndex()
    {
        $user = Auth::user();
        if ($user->role === 1) {
            $posts = Post::paginate(3);
        }else{
            $posts = Post::where('user_id', $user->id)->paginate(3);
        }
        return view('admin.index', ['posts' => $posts]);
    }

    public function getAdminCreate()
    {
        return view('admin.create');
    }

    public function getAdminUpdate($id)
    {
        $post = Post::find($id);
        return view('admin.edit', ['post' => $post, 'postId' => $id]);
    }

    public function postAdminCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5|unique:posts',
            'content' => 'required|min:10'
        ]);
        $user = Auth::user();
        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        $user->posts()->save($post);
        //$post->save();

        return redirect()->route('admin.index')->with('info', 'Post created, Title is: ' . $request->input('title'));
    }

    public function postAdminUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5|unique:posts,title,'. $request->input('id'),
            'content' => 'required|min:10'
        ]);
        $post = Post::find($request->input('id'));
        if (Gate::denies('update-post', $post)) {
            return redirect()->back();
        }
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->is_active = $request->input('is_active', 0);
        $post->save();
        return redirect()->route('admin.index')->with('info', 'Post edited, new Title is: ' . $request->input('title'));
    }
}
