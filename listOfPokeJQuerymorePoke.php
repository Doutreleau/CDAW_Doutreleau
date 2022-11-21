<!DOCTYPE html>
<html>
    <head>
        <title>Display Pokédex</title>
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">  
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
   
        <script> $(document).ready( function () {   
             $('#Pokedex').DataTable();
        } );</script>
   
    </head>
    
    <body>
        <h1>Pokédex</h1>
        <table id="Pokedex", class="display">
            <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Id</th>
            </tr>
            </thead>
            <tbody>
        <?php 
            function showPokemonsOfOnePage($page){
                $page = json_decode($page);
                foreach($page->results as $pokemon){
                    //get the id of each pokemon
                    $url = $pokemon->url;
                    $values = parse_url($url);
                    $pokemonId = explode('/',$values['path'])[4];
    
                    //gets the image ("sprite") of the pokemon
                    $basePokemonPage = 'https://pokeapi.co/api/v2/pokemon/';
                    $pokemonPage = $basePokemonPage.$pokemonId;
                    $image = file_get_contents($pokemonPage);
                    $image = json_decode($image);
    
                    ?>
                    
                    <tr>
                    <td> <?php echo $pokemon->name; ?> </td>
                    <td> <img src=<?php echo $image->sprites->front_default; ?> /> </td>
                    <td> <?php echo $pokemonId; ?> </td>
                    </tr>
                    <?php
                }
            }

            //get the Pokemons of the first page
            $page = file_get_contents('https://pokeapi.co/api/v2/pokemon/');
            showPokemonsOfOnePage($page);

            //get the Pokemons of the next pages (the number of them is $num_of_pages_to_cover)
            $num_of_pages_to_cover = 10;
            for ($num_of_pages = 1; $num_of_pages<$num_of_pages_to_cover; $num_of_pages++){
                $num_of_offset = $num_of_pages * 20;
                $urlPage = 'https://pokeapi.co/api/v2/pokemon/'.'?offset='.$num_of_offset.'&limit=20';
                $page = file_get_contents($urlPage);
                showPokemonsOfOnePage($page);
            }


            




            
        ?>

        
            </tbody>

        
    </body>
</html>
