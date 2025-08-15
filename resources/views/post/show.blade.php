@extends('layouts.main')
@section('content')
    <div class="container">
        <div>{{ $post->id }}. {{ $post->title }}</div>
        <div>
            {{ $post->content }}
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route("post.index") }}">Все посты</a>
            <a class="btn btn-primary" href="{{ route('post.edit', $post->id) }}">Редактировать</a>
            <form action="{{ route('post.delete', $post->id) }}" method="post">
                @csrf
                @method('delete')
                <input class="btn btn-primary" type="submit" value="Удалить">
            </form>
        </div>
    </div>
@endsection