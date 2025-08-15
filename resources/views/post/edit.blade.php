@extends('layouts.main')
@section('content')
    <div class="container">
        <form action="{{ route("post.update", $post->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="title" name="title" value="{{ $post->title }}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content">{{ $post->content }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="text" class="form-control" id="image" aria-describedby="Image" name="image" value="{{ $post->image }}">
            </div>
            <div class="mb-3">
                <label for="likes" class="form-label">Likes</label>
                <input type="number" class="form-control" id="likes" aria-describedby="Likes" name="likes" value="{{ $post->likes }}">
            </div>
            <div class="mb-3">
                <label class="form-label" for="category">Category</label>
                <select class="form-select" id="category" name="category_id" aria-label="Default select example">
                    @foreach ($categories as $category)
                        <option 
                            {{ $category->id === $post->category_id ? "selected" : ""}}
                            value="{{ $category->id }}"> {{ $category->title }} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="tags">Tags</label>
                <select class="form-select" id="tags" name="tags[]" multiple aria-label="Multiple select example">
                    @foreach ($tags as $tag)
                        <option 
                            @foreach ($post->tags as $postTag)
                                {{ $tag->id === $postTag->id ? "selected" : ""}}
                            @endforeach
                         value="{{ $tag->id }}">{{ $tag->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection