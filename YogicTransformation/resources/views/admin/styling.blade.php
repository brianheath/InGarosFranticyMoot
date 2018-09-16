@extends('layouts.admin')

@section('title', 'Admin - Styling')

@section('content')

<h2>Styling</h2>

<form style="margin: 20px 0 20px 0;" action="{{ url('admin/styling') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for=""></label>
        <input class="form-control" name="" id="" placeholder="" value="{{ '' }}">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection