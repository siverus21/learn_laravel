@extends('layouts.main')
@section('content')
    <div class="container">
        <form action="{{ route("post.store") }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input 
                
                value="{{ old('title') }}"

                type="text" class="form-control" id="title" aria-describedby="title" name="title">
                
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="text" class="form-control" id="image" aria-describedby="Image" name="image">
            </div>
            <div class="mb-3">
                <label for="likes" class="form-label">Likes</label>
                <input type="number" class="form-control" id="likes" aria-describedby="Likes" name="likes">
            </div>
            <div class="mb-3">
                <label class="form-label" for="category">Category</label>
                <select class="form-select" id="category" name="category_id" aria-label="Default select example">
                    @foreach ($categories as $category)
                        <option 
                            {{ old('category_id') == $category->id ? 'selected' : ''}}
                        value="{{ $category->id }}"> {{ $category->title }} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="tags">Tags</label>
                <select class="form-select" id="tags" name="tags[]" multiple aria-label="Multiple select example">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection