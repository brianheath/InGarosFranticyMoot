@extends('layouts.page')

@section('title', $page['title'])

@section('content')
@foreach ($page->posts as $post)
    <div class="content">
        <h1>{{ $post['title'] }}</h1>
        
        @if ($post['user_id'])
        <h4>by {{ $post->user['name'] }}</h4>
        @endif

        @if ($post['show_date'])
        <h5>{{ $post['updated_at'] }}</h5>
        @endif

        <div class="container">
            {{ $post['body'] }}
        </div>
    </div>
@endforeach
@endsection