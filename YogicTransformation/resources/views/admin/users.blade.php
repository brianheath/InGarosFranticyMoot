@extends('layouts.admin')

@section('title', 'Admin - Users')

@section('content')

<h2>Users</h2>

@foreach ($users as $user)
    <p>{{ $user }}</p>
@endforeach
    
@endsection