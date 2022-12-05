<!DOCTYPE html>
<html lang="en">
<head>
    <title> PokemonStop </title>
    <link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">
   
</head>
<body>

    <img class='userPagebackgroundImage' src = 'assets/img/background.jpg'></div>

    <div class='userPageCircleParam'></div>
    <img class='userPageParamImage'  src = 'assets/img/parameters.png'></img>
    <a class='userPageParamText' href="/param">Parameters</a>

    <div class='userPageCircleHelp'></div>
    <img class='userPageHelpImage'  src = 'assets/img/help.png'></img>
    <div class='userPageHelpText'>Help</div>

    <div class='userPageRect1'></div>
    <div class='userPageRect2'></div>
    <div class='userPageLevel'>Level : {{ intdiv(auth()->user()->nb_victories,10) }} </div>
    <a class='userPageEnergies' href="#">Energies mastered :
        <?php
        $userId = auth()->user()->id;
        $energies = DB::table("energy_mastered")->get(["id_user", "id_energy"])->where("id_user","=",$userId);
        foreach($energies as $energy){
            
            $energiesNames = DB::table("energy")->get(["id", "name"])->where("id","=",$energy->id_energy);
            foreach($energiesNames as $energyName){
                echo $energyName->name;
                echo "\r\n";
            }
        
        }
        ?></a>
        
    <a class='userPageLogout'  href="/logout">Log out</a>
    <img class='userPageLogoutImage' src = 'assets/img/logout2.png'></img>

    <img class='userPagePokedexShape' src = 'assets/img/shape1.png'>></img>
    <img class='userPagePokedexImage' src = 'assets/img/pokedex.png'></img>
    <a class='userPagePokedexText' href="/pokemons">Open Pokedex</a>

    
    <img class='userPageBattleShape' src = 'assets/img/shape2.png'>></img>
    <img class='userPageBattleImage'  src = 'assets/img/battle.png'></img>
    <a class='userPageBattleText' href="/choiceSecondUser"> Start a battle</a>
    
    @if( auth()->check() )
        <li class="nav-item">
            <h3 class='userPageHello' href="#">Hi {{ auth()->user()->name }} !</h3>
        </li>
    @endif

    
</body>
</html>

