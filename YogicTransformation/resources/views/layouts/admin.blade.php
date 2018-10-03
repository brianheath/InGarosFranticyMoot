<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
</head>

<body>
    <nav class="navbar navbar-default navbar-dark bg-dark">
        <a class="navbar-text" href="{{ url('/') }}">Home, Jeeves</a>
        <div>
            <a class="btn btn-outline-light" role="button" href="/logout">Logout</a>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-sm-auto">
                <nav class="navbar flex-column">
                    <a class="nav-link" href="{{ url('admin/') }}"><i class="fas fa-cog"></i>General&nbsp;Options</a>
                    <a class="nav-link" href="{{ url('admin/site-config') }}"><i class="fas fa-globe"></i>Site&nbsp;Config</a>
                    <a class="nav-link" href="{{ url('admin/pages') }}"><i class="fas fa-file-alt"></i>Pages</a>
                    <a class="nav-link" href="{{ url('admin/posts') }}"><i class="fas fa-pencil-alt"></i>Posts</a>
                    <a class="nav-link" href="{{ url('admin/users') }}"><i class="fas fa-users"></i>Users</a>
                    <a class="nav-link" href="{{ url('admin/permissions') }}"><i class="fas fa-user-lock"></i>Permissions</a>
                    <a class="nav-link" href="{{ url('admin/styling') }}"><i class="fas fa-palette"></i>Styling</a>
                    <a class="nav-link" href="{{ url('admin/email') }}"><i class="fas fa-envelope"></i>Email</a>
                    <a class="nav-link" href="{{ url('admin/components') }}"><i class="fas fa-cubes"></i>Components</a>
                    <a class="nav-link" href="{{ url('admin/reports') }}"><i class="fas fa-chart-bar"></i>Reports</a>
                </nav>
            </div>

            <div style="padding: 25px;" class="col-sm">
            @section('content')
                @show
            </div>

        </div>
    </div>
    
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="{{ asset('/js/scripts.js') }}"></script>

</body>
</html>