@extends('layouts.admin')

@section('title', 'Admin - Email')

@section('content')

<h2>Email</h2>

<form style="margin: 20px 0 20px 0;" action="" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="">Support</label>
        <input class="form-control" name="email-support" id="email_support" placeholder="" value="">
        <small class='form-text text-muted'>This is the email address for the support team</small>
    </div>
    <div class="form-group">
        <label for="">Administer</label>
        <input class="form-control" name="email-admin" id="email_admin" placeholder="" value="">
        <small class="form-text text-muted">This is the email address for the website adminstrator</small>
    </div>
    
    <h5>New User Email</h5>
    <div class="form-group">
        <small class="form-text text-muted">
            This is the Subject &amp; Message that is sent to a user when a new
            account is set up for them
        </small>
        <label for="newuser-subject">Subject</label>
        <input class="form-control" name="newuser-subject" id="newuser_subject" placeholder="" value="">
    </div>
    <div class="form-group">
        <label for="newuser-message">Message</label>
        <textarea class="form-control" name="newuser-message" id="newuser_message" rows="14"></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection