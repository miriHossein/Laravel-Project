<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\CommentReply;
use App\Http\Requests\PostEditRequest;
use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use App\Photo;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(11);
        $comments = Comment::all();
        return view('admin.posts.index', compact('posts' ,'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('users', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $input = $request->all();

        if($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();

            $file->move('postsImage', $name);
            $photo = Photo::create(['file'=> $name]);
            $input['photo_id'] = $photo->id;
        }

        Post::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comment::where('post_id', $id)->where('is_active', 1)->get();
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
        $posts = Post::findOrFail($id);
        return view('admin.posts.edit', compact('users', 'categories', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $input = $request->all();

        if($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();

            $file->move('postsImage', $name);
            $photo = Photo::create(['file'=> $name]);
            $input['photo_id'] = $photo->id;
        }
        $post->update($input);
        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        unlink(public_path() . "/postsImage/" . $post->photo->file);
        $post->delete();
        return redirect('admin/posts');
    }
}
