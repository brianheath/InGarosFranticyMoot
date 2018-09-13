<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

<body>
    
    @if($options['navbar'])
        @include('components.navbar')
    @endif
    
    @if($options['header'])
        @include('components.header')
    @endif
    
    @if($options['content'])
        @section('content')
            @show
    @endif
    
    @if($options['footer'])
        @include('components.footer')
    @endif
    
</body>
</html>