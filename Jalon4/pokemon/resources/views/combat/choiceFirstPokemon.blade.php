
<head>
    <title> PokemonStop </title>
    <link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    
        <script> $(document).ready( function () {   
                $('#Pokedex').DataTable();
        } );
        
        </script>
 </head>

    <h5> Click on a pokemon to choose it </h5>
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
        echo $idUser1;
        foreach ($pokemons as $pokemon) {


            //$max_id = DB::table("combat")->query('SELECT MAX(id) AS `maxid` FROM `combat')->row()->maxid;
            


            $energies = DB::table("energy")->get(["id", "name"])->where("id","=",$pokemon->energy);
            foreach($energies as $energy){
                if (!strcmp($energy->name, "bug")){
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
        ?>
        
        </tbody>

        <script>
    $(document).ready(function()
    {
    $('#name').click( function () {
      alert("test") ;
    });
    });


    $("#Pokedex").delegate("td", "click", function() {
        alert(this.textContent);
    });
    </script>
