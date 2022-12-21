
@extends('template')
@section('content1')
    <link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    
        <script> $(document).ready( function () {   
                $('#Pokedex').DataTable();
        } );
        
        </script>

<div  class='backgroundPokedex'></div>

 <form method="POST" action="/choicePokemonUser2">
        {{ csrf_field() }}
        <input style =" position: absolute; top:60px; left: 310px" type="text" placeholder="Enter the name of the pokemon you choose" name="pokemonName">
        <div class="form-group">
            <button style="cursor:pointer;position: absolute; top:100px; left: 310px" type="submit" class="btn btn-primary">Choose pokemon</button>
        </div>
    </form>

    <table id="Pokedex", class="display">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Image</th>
            <th>Energy</th>
            <th>Pv</th>
            <th>Level</th>
            <th>Attaque Normale</th>
            <th>Attaque spéciale</th>
            <th>Défense spéciale</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $currentUser = "The current user is ".$user1Name.", please click on the pokemon you want to choose";
        ?>
        <h4 style =" position: absolute; top: 20px; left: 320px; font-family: 'Enriqueta';  font-style: normal;">{{$currentUser}}</h4>
  

        <?php 
        foreach ($pokemons as $pokemon) {

            $energies = DB::table("energy")->get(["id", "name"])->where("id","=",$pokemon->energy);
            foreach($energies as $energy){
                foreach($listEnergiesUser1 as $energyUser1){

                    if (strcmp($energy->name, $energyUser1)==0){
            ?>

            
           <tr>
            <td> <?php echo $pokemon->id; ?> </td>
            <td> <?php echo $pokemon->name; ?> </td>
            <td> <img src=<?php echo $pokemon->path; ?> /> </td>
            <td> <?php 
            $energies = DB::table("energy")->get(["id", "name"])->where("id","=",$pokemon->energy);
            foreach($energies as $energy){
                echo $energy->name;
            }
             ?> </td>
            <td> <?php echo $pokemon->pv_max; ?> </td>
            <td> <?php echo $pokemon->level; ?> </td>
            <td> <?php echo $pokemon->scoreNormalAttack; ?> </td>
            <td> <?php echo $pokemon->scoreSpecialAttack; ?> </td>
            <td> <?php echo $pokemon->scoreSpecialDefense; ?> </td>
            </tr>
            <?php
                    }
                }
            }
        }        
        ?>
        
        </tbody>

        <script>



    $("#Pokedex").delegate("td", "click", function() {
        alert(this.textContent);
    });
    </script>
    
    @endsection
