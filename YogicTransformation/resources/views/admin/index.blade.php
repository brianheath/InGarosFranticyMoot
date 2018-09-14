@extends('layouts.admin')

@section('title', 'Admin - General Options')

@section('content')

<h2>General Options</h2>

<form style="margin: 20px 0 20px 0;" action="{{ url('admin/general-options') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="">Something will go here eventually...</label>
        <input class="form-control" id="" placeholder="" value="{{ $options['site_tagline'] }}">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection