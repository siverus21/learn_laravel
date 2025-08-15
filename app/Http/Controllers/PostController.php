<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post/index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post/create', compact('categories', 'tags'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'string',
            'image' => 'string',
            'likes' => 'integer',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);
        $post = Post::create($data);
        $post->tags()->attach($tags);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post/show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post/edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
            'likes' => 'integer',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post = $post->fresh();
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }

    // public function delete()
    // {
    //     $post = Post::find(2);
    //     $post->delete();
    //     dd('delete');
    // }

    // public function restore()
    // {
    //     $post = Post::withTrashed()->find(2);
    //     $post->restore();
    //     dd('restore');
    // }

    // public function firstOrCreate()
    // {
    //     $anotherPost = [
    //         'title' => 'some post',
    //         'content' => 'some content',
    //         'image' => 'some.jpg',
    //         'likes' => 100,
    //         'is_published' => 1,
    //     ];
    //     $myPost = Post::firstOrCreate([
    //         'title' => 'some post',
    //     ], $anotherPost);
    //     dump($myPost->content);
    //     dd('finish');
    // }

    // public function updateOrCreate()
    // {
    //     $anotherPost = [
    //         'title' => 'some post',
    //         'content' => 'some content update',
    //         'image' => 'some.jpg',
    //         'likes' => 100,
    //         'is_published' => 1,
    //     ];
    //     $myPost = Post::updateOrCreate([
    //         'title' => 'some post',
    //     ], $anotherPost);
    //     dump($myPost->content);
    //     dd('finish');
    // }
}
