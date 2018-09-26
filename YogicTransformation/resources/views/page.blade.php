@extends('layouts.page')

@section('title', $page['title'])

@section('navbar')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" style="cursor: default;">{{ $options['nav_brand'] }}</a>
    <div class="navbar-nav">
        <a class="nav-item nav-link" href="{{ url('/') }}">Home</a>
        
        @foreach ($links as $link)
            <a class="nav-item nav-link" href="{{ $link['url'] }}">{{ $link['title'] }}</a>
        @endforeach
            
    </div>
</nav>
@endsection

@section('content')
@foreach ($page->posts as $post)
@if ($post['published'])
    <div class="container">
        <h1>{{ $post['title'] }}</h1>
        
        @if ($post['show_author'])
        <h4>by {{ $post->user['name'] }}</h4>
        @endif
        
        @if ($post['show_date'])
        <h5>{{ date('M jS, Y', strtotime($post['updated_at'])) }}</h5>
        @endif
        
        <div class="container">
            {!! $post['body'] !!}
        </div>
    </div>
@endif
@endforeach
@endsection