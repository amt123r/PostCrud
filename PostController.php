<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::all();
        
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
    
        return view('posts.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Post::create($request->only(['title', 'description']));

        
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }
    
    public function update(Request $request, $id)
    {
     
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        
        $post = Post::findOrFail($id);
        
        $post->update($request->only(['title', 'description']));

    
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }
    
    public function destroy($id)
    {
        
        $post = Post::findOrFail($id);
        
        $post->delete();

       
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }



}