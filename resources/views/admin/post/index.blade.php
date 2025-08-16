@extends('layouts.admin')

@section('content')
        <div>
            <a class="btn btn-primary mb-3" href="{{ route('post.create') }}">Создать пост</a>
        </div>

        @foreach ($posts as $post)
            <div>
                <a href="{{ route('post.show', $post->id) }}">{{ $post->id }}. {{ $post->title }}</a>
            </div>
        @endforeach
        <div>
            {{ $posts->withQueryString()->links() }}
        </div>
@endsection