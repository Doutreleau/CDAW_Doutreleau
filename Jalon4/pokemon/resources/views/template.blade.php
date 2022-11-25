<!DOCTYPE html>
<html lang="en">
<head>
    <title> PokemonStop </title>
    <link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    

</head>
<body>
    <h1> Welcome </h1>

    @if( auth()->check() )
        <li class="nav-item">
            <h3 class="nav-link font-weight-bold" href="#">Hi {{ auth()->user()->name }}</h3>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/logout">Log Out</a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="/login">Log In</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/register">Register</a>
        </li>
    @endif
    @yield('content')
    

    
</body>
</html>