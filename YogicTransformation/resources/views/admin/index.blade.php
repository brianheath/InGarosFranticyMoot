@extends('layouts.admin')

@section('title', 'Admin - General Options')

@section('content')

<h2>General Options</h2>

<form style="margin: 20px 0 20px 0;" action="{{ url('admin/general-options') }}" method="post">
    {{ csrf_field() }}
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
            Select the default (home) page
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Wonderful</a>
            <a class="dropdown-item" href="#">AWesome</a>
            <a class="dropdown-item" href="#">Nifty</a>
            <a class="dropdown-item" href="#">Coolio</a>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection