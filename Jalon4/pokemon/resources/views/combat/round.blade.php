@extends('template')
@section('content1')
    
<link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">
<div  class='backgroundPokedex'></div>

    <img style="position: absolute; top: 160px; left:370px; width: 580px; height: width; transform: rotate(52.01deg);" src = 'assets/img/shape2.png'></div>
    
    <?php 
        $pokeDown = "";
        if($isPokeDown){
            $pokeDown = "The attacked pokemon does not have any hp left. It was replaced by " . $poke1Name;
        }
        ?>
        <h2 style =" position: absolute; top: 120px; left: 360px; font-family: 'Enriqueta';  font-style: normal;">{{$pokeDown}}</h2>


    <?php 
        $currentUser = "The current user is ".$user1;
        $pokeUser1 = $user1 . "'s pokemon:";
        $pokeUser2 = $user2 . "'s pokemon:";
        ?>
    <h2 style =" position: absolute; top: 350px; left: 360px; font-family: 'Enriqueta';  font-style: normal;">{{$currentUser}}</h2>
    <h3 style =" position: absolute; top: 400px; left: 360px; font-family: 'Enriqueta';  font-style: normal;">{{$pokeUser1}}</h3>

    
    <img style = "position: absolute; top: 420px; left:340px; width: 300px; height: width" src=<?php echo $poke1Image; ?> />
    <h3 style =" position: absolute; top: 400px; left: 630px; font-family: 'Enriqueta';  font-style: normal;">{{$poke1Name}}</h3>
    <h3 style =" position: absolute; top: 450px; left: 630px; font-family: 'Enriqueta';  font-style: normal;"><?php echo $poke1Pv . " HP"; ?></h3>

    
    <h3 style =" position: absolute; top: 150px;  right:5%;font-family: 'Enriqueta';  font-style: normal;">{{$pokeUser2}}</h3>
    <img style = "position: absolute; top: 200px; right:5%; width: 300px; height: width" src=<?php echo $poke2Image; ?> />
    <h3 style =" position: absolute; top: 200px;  right:5%; font-family: 'Enriqueta';  font-style: normal;">{{$poke2Name}}</h3>
    <h3 style =" position: absolute; top: 250px;  right:5%; font-family: 'Enriqueta';  font-style: normal;"><?php echo $poke2Pv . " HP"; ?></h3>

    <form method="POST" action="/doRound">
    {{ csrf_field() }}
        <input type="hidden" name="user1[]" value = "{{$user1}}">
        <input type="hidden" name="user2[]" value = "{{$user2}}">

        <input type="hidden" name="poke1[]" value = "{{$poke1Name}}">
        <input type="hidden" name="poke1ScoreSpecialAttack[]" value = "{{$poke1ScoreSpecialAttack}}">
        <input type="hidden" name="poke1ScoreNormalAttack[]" value = "{{$poke1ScoreNormalAttack}}">
        <input type="hidden" name="poke1ScoreSpecialDefense[]" value = "{{$poke1ScoreSpecialDefense}}">
        <input type="hidden" name="poke1Pv[]" value = "{{$poke1Pv}}">
        <input type="hidden" name="poke1Image[]" value = "{{$poke1Image}}">

        
        <input type="hidden" name="poke2[]" value = "{{$poke2Name}}">
        <input type="hidden" name="poke2ScoreSpecialAttack[]" value = "{{$poke2ScoreSpecialAttack}}">
        <input type="hidden" name="poke2ScoreNormalAttack[]" value = "{{$poke2ScoreNormalAttack}}">
        <input type="hidden" name="poke2ScoreSpecialDefense[]" value = "{{$poke2ScoreSpecialDefense}}">
        <input type="hidden" name="poke2Pv[]" value = "{{$poke2Pv}}">
        <input type="hidden" name="poke2Image[]" value = "{{$poke2Image}}">

        <div class="form-group">
            <input style="position: absolute; top:550px; left: 630px" name="Attaque_normale" type="submit" class="button" value="Attaque normale">
            <h7 style="position: absolute; top:550px; left: 780px" >{{$poke1ScoreNormalAttack}}</h7>
        </div>
        
        <div class="form-group">
            <input style="position: absolute; top:600px; left: 630px" name="Attaque_speciale" type="submit" class="button" value="Attaque speciale">
            <h7 style="position: absolute; top:600px; left: 780px" >{{$poke1ScoreSpecialAttack}}</h7>
        </div>
        
        <div class="form-group">
            <input style="position: absolute; top:650px; left: 630px" name="Defense_speciale" type="submit" class="button" value="Defense speciale">
            <h7 style="position: absolute; top:650px; left: 780px" >{{$poke1ScoreSpecialDefense}}</h7>
        </div>
    </form>

@endsection