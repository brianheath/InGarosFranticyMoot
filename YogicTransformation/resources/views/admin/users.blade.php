@extends('layouts.admin')

@section('title', 'Admin - Users')

@section('content')

<h2>Users</h2>

<nav class="nav nav-tabs" style="margin-top: 30px; margin-bottom: 30px;">
    <a class="nav-link nav-item active" data-toggle="tab" role="tab" href="#user_list">Current Users</a>
    <a class="nav-link nav-item" data-toggle="tab" role="tab" href="#add_user">Add a new User</a>
</nav>

<div class="tab-content">
    <div class="tab-pane fade" role="tabpanel" id="add_user">
        <form id="new_user" action="{{ url('admin/adduser') }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label for="user_name">Name of the User</label>
                <input class="form-control" name="user-name" id="user_name" placeholder="eg: Don Joe" />
            </div>
            
            <div class="form-group">
                <label for="user_email">User's Email</label>
                <input type="email" class="form-control" name="user-email" id="user_email" placeholder="eg: jessica@rabbit.com" />
            </div>

            <div class="form-group">
                <label for="user_password">User's Password</label>
                <a href="#" class="btn btn-success btn-sm generate-password" style="margin-left: 30px;">Click here to generate one</a>
                <input class="form-control" name="user-password" id="user_password" placeholder="Make it cryptic!" />
            </div>
            
            <div class="form-group">
                <div class="dropdown add-user-dropdown">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                        Select the User's Role
                    </button>
                    <small class="form-text text-muted"></small>
                    <div class="dropdown-menu">
                        @foreach ($roles as $role)
                        <a class="dropdown-item" href="#" item-id="{{ $role['id'] }}">"{{ $role['description'] }}"</a>
                        @endforeach
                    </div>
                </div>
                <input type="hidden" name="user-role-id" />
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="check-send-email" id="check_send_email" />
                <label for="check_send_email">Email the user and notify them that a new account has been set up.</label>
            </div>

            {{--<div class="form-group">
                <label for="post_body">The post body <small class="text-muted" style="margin-left: 10px;">(HTML is allowed)</small></label>
                <textarea class="form-control" name="post-body" id="post_body" rows="20"></textarea>
            </div>

            
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="check-show-date" id="check_show_date" />
                <label for="check_show_date">Show the date it was written</label>
            </div>
            
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="check-publish" id="check_publish" />
                <label for="check_publish">Publish this post</label>
            </div>--}}
            
            <div class="container-fluid" style="margin-top: 30px;">
                <div class="row">
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">Add this User</button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
    
    <div class="tab-pane fade show active" role="tabpanel" id="user_list">
        <table class="table table-hover users">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role(s)</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach ($users as $user)
                <tr id="item_{{ $user['id'] }}_row">
                    <td>{{ $user['name'] }}</td>
                    <td id="item_{{ $user['id'] }}_title">{{ $user['email'] }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role['description'] }}<br>
                        @endforeach
                    </td>
                    <td>TBD</td>
                    <td>{{ date('M jS, Y', strtotime($user['created_at'])) }}</td>
                    <td item-id="{{ $user['id'] }}" item-type="user">
                        <i class="fas fa-edit" action="edit"></i>
                        <i class="fas fa-trash-alt" action="delete"></i>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
        
</div>

@endsection