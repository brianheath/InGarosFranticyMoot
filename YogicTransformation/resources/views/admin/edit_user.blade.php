@extends('layouts.admin')

@section('title', 'Admin - Edit User')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <h2>Edit User</h2>
        </div>
    </div>
</div>

<hr>

<form action="{{ url('/admin/user/'.$user['id']) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    
    <input type="hidden" name="user-id" value="{{ $user->id }}" />
    <div class="form-group">
        <label>Name</label>
        <input class="form-control" id="user_name" name="user-name" value="{{ $user->name }}" />
    </div>
    
    <div class="form-group">
        <label>E-mail address</label>
        <input class="form-control" id="user_email" name="user-email" value="{{ $user->email }}"/>
    </div>

    <div class="form-group">
        <h6>Roles</h6>
        @foreach ($roles as $role)
        <button type="button" class="btn btn-{{ $user->is($role['slug']) ? 'primary' : 'secondary' }} btn-sm btn-role"
                value="{{ $role['id'] }}">{{ $role['description'] }}</button>
        @endforeach
        <input type="hidden" id="role_ids" name="role-ids" value="" />
        <small class="form-text text-muted">Click to toggle the user's role(s)</small>
    </div>
        
    <div class="form-group">
        <span style="font-size: 1.1rem;">Date created:</span>
        <span style="font-size: .9rem;">
            {{ date('M j, Y @ H:i', strtotime($user->created_at)) }}
        </span>
        <br>
        <span style="font-size: 1.1rem;">Date of last update:</span>
        <span style="font-size: .9rem;">
            {{ date('M j, Y @ H:i', strtotime($user->updated_at)) }}
        </span>
        <br>
        <small class="form-text text-muted">All times are GMT</small>
    </div>
    
    <div class="container-fluid" style="margin-top: 40px;">
        <div class="row">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>

</form>

@endsection