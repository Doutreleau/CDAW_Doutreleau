<!DOCTYPE html>
<html lang="en">
<head>
    <title> PokemonStop </title>
    <link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">

</head>
<body>

    <div  class='rectangleRegisterLogin'></div>
    <h2 style =" position: absolute; top:500px; left: 32%" >Log in of a second user</h2>

    <form method="POST" action="/loginSecondUser">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email" style =" position: absolute; top:580px; left: 32%" >Email:</label>
            <input type="email" class="form-control" id="email" name="email" style =" position: absolute; top:580px; left: 42%; width: 10%">
        </div>

        <div class="form-group">
            <label for="password" style =" position: absolute; top:650px; left: 32%">Password:</label>
            <input type="password" class="form-control" id="password" name="password" style =" position: absolute; top:650px; left: 42%; width: 10%">
        </div>

        <div class="form-group">
            <button style="cursor:pointer; position: absolute; top:750px; left: 32%" type="submit" class="btn btn-primary">Login</button>
        </div>
        @include('partials.formerrors')
    </form>


 
</body>
</html>

