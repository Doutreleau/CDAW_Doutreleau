<!DOCTYPE html>
<html lang="en">
<head>
    <title> PokemonStop </title>
    <link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">

</head>
<body>

    <div  class='rectangleRegisterLogin'></div>
    <h2 style =" position: absolute; top:500px; left: 32%" >Change name</h2>
    
    <form method="POST" action="/namechange">
        {{ csrf_field() }}
        <div class="form-group">
            <label style =" position: absolute; top:580px; left: 32%" >New name:</label>
            <input class="form-control" name="newName" style =" position: absolute; top:580px; left: 42%; width: 10%">
        </div>

        <div class="form-group">
            <label for="password" style =" position: absolute; top:650px; left: 32%">Password:</label>
            <input type="password" class="form-control" id="password" name="password" style =" position: absolute; top:650px; left: 42%; width: 10%">
        </div>

        <div class="form-group">
            <button style="cursor:pointer; position: absolute; top:750px; left: 32%" type="submit" class="btn btn-primary">Change name</button>
        </div>
    </form>

    
</body>
</html>
