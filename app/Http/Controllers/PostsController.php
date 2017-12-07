<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use DateTime;

class PostsController extends Controller
{

   public function __construct()
   {
      $this->middleware('role:superadministrator|administrator|editor|author|contributor');
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
          'title' => 'required|max:255',
          'post_content' => 'required'
     ]);


     $post = new Post();
     $post->title = $request->title;
     $post->slug = $request->slug;
     $post->author_id = Auth::user()->id;
     $post->excerpt = "none";
     $post->content = $request->post_content;
     $post->comment_count = 0;
     $post->published_at = new DateTime();
     $post->created_at = new DateTime();
     $post->updated_at = new DateTime();

     if ($post->save())
     {
        return redirect()->route('posts.show', $post->id);
     }
     else
     {
          Session::flash('danger', 'Sorry a problem occured while creating this post');
          return redirect()->route('posts.create');
     }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function apiCheckUnique(Request $request)
    {
      return json_encode(!Post::where('slug', '=', $request->slug)->exists());
   }
}
