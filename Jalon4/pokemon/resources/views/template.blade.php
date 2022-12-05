<!DOCTYPE html>
<html lang="en">
<head>
    <title> PokemonStop </title>
    <link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    
    @yield('style')
</head>
<body>
    
    <img class='backgroundImage' src = 'assets/img/background.jpg'></div>
    <div  class='rectangleYellow1'></div>
    <div class='rectangleRed1'></div>
    <div class='rectangleRed2'></div>
    <div class='rectangleRed3'></div>
    <img class='imageHelp' src = 'assets/img/help.png'></div>
    <img class='imagePokedex' src = 'assets/img/pokedex.png'></div>
    <img class='imageReplayBattles' src = 'assets/img/battle.png'></div>
    <img class='imageStats' src = 'assets/img/statistics.png'></div>
    <a class='textHelp'>Help</a>
    <a href="/pokemons" class='textPokedex'>Open Pokedex</a>
    <a class='textBattle'>Replay previous battles</a>
    <a class='textStat'>View players statistics</a>
    <div  class='rectLogo'></div>
    <img class='logo' src = 'assets/img/logo.png'></div>
    <a class='motoText'>The website to play with pokemons !</a>
    
    @yield('content')
    

    
</body>
</html>


