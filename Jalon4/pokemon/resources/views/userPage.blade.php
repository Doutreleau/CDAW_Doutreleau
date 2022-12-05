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

    <img class='userPagebackgroundImage' src = 'assets/img/background.jpg'></div>

    <div class='userPageCircleParam'></div>
    <img class='userPageParamImage'  src = 'assets/img/parameters.png'></img>
    <div class='userPageParamText'>Parameters</div>

    <div class='userPageCircleHelp'></div>
    <img class='userPageHelpImage'  src = 'assets/img/help.png'></img>
    <div class='userPageHelpText'>Help</div>

    <div class='userPageRect1'></div>
    <div class='userPageRect2'></div>
    <div class='userPageLevel'>Level : {{ intdiv(auth()->user()->nb_victories,10) }} </div>
    <div class='userPageEnergies'>Energies mastered : </div>
    <a class='userPageLogout'  href="/logout">Log out</a>
    <img class='userPageLogoutImage' src = 'assets/img/logout2.png'></img>

    <img class='userPagePokedexShape' src = 'assets/img/shape1.png'>></img>
    <img class='userPagePokedexImage' src = 'assets/img/pokedex.png'></img>
    <a class='userPagePokedexText' href="/pokemons">Open Pokedex</a>

    
    <img class='userPageBattleShape' src = 'assets/img/shape2.png'>></img>
    <img class='userPageBattleImage'  src = 'assets/img/battle.png'></img>
    <div class='userPageBattleText'> Start a battle</div>
    
    @if( auth()->check() )
        <li class="nav-item">
            <h3 class='userPageHello' href="#">Hi {{ auth()->user()->name }} !</h3>
        </li>
    @endif

    
</body>
</html>

