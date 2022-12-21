<!DOCTYPE html>
<html lang="en">
<head>
    <title> PokemonStop </title>
    <link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">

</head>
<body>


<?php 
    
    //get the names of the players
    $matches = DB::table('combat')->where('id','=',$matchId)->get(['id_user1','id_user2']);
    foreach($matches as $match){
        $id_user1 = $match->id_user1;
        $id_user2 = $match->id_user2;
    }

    $user1s= DB::table('users')->where('id','=',$id_user1)->get(['name']);
    foreach($user1s as $user1){
        $name_user1 = $user1->name;
    }

    $user2s= DB::table('users')->where('id','=',$id_user2)->get(['name']);
    foreach($user2s as $user2){
        $name_user2 = $user2->name;
    }
    //get the other data
    $rounds = DB::table('tour')->where('id_combat','=',$matchId)->get(['id_type','poke1Name','poke2Name','poke1Pv','poke2Pv']);
    $player1IsPlaying = true; //will determine which player is playing
    $count = 0;
    foreach($rounds as $round){
        $count = $count +1;
        $id_type = $round->id_type;
        $names_type = DB::table('types_combat')->where('id','=',$id_type)->get(['id','type']);
        foreach($names_type as $name_type){
            $name_type_fight = $name_type->type;//corresponds to "attaque spécial", "attaque normale", "defense spéciale"
        }
        
        if ($player1IsPlaying){
            $message = $name_user1;
            $player1IsPlaying = false;
        }
        else{
            $message = $name_user2;
            $player1IsPlaying = true;
        }

        $message = $message." used ".$round->poke1Name;

        if ($id_type == 1){ //ie the defense was used
            $message = $message. "'s defense";
        }
        else if ($id_type == 2){
            $message = $message."'s special attack on ". $round->poke2Name;
        }
        else{
            $message = $message."'s normal attack on ". $round->poke2Name;
        }
        $message = $message.". " . $round->poke1Name . " now has " . $round->poke1Pv . " HP, and " . $round->poke2Name;
        
        if(($round->poke2Pv) >0){
            $message = $message . " now has " . $round->poke2Pv . "HP. ";
        }
        else{
            $message = $message . " does not have any HP left. ";
        }
        $a = 80 * $count;?>

        <h4 style =" position: absolute; top: {{$a}}px; left: 310px">{{$message}}</h4>
        <?php 
    }
    $count = $count + 1;
    $a = 80 * $count;
    if($player1IsPlaying){
        $end = "The winner is " . $name_user2 . ". ";
    }
    else{        
        $end = "The winner is " . $name_user1 . ". ";
    }
    ?>
    <h4 style =" position: absolute; top: {{$a}}px; left: 310px">{{$end}}</h4>




    
</body>
</html>