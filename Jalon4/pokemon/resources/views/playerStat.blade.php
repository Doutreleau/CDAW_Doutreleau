@extends('template')
@section('content1')

    <link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    
        <script> $(document).ready( function () {   
                $('#Pokedex').DataTable();
        } );</script>

    <div  class='backgroundPokedex'></div>
    <h3>Statistics of users</h3>
    <table id="Pokedex", class="display">
        <thead>
        <tr>
            <th>Name</th>
            <th>Number of victories</th>
            <th>Energies mastered</th>
        </tr>
        </thead>
        <tbody>

        <?php 
        foreach ($users as $user) {
            ?>
           <tr>
            <td> <?php echo $user->name; ?> </td>
            <td> <?php echo $user->nb_victories; ?> </td>
            <td> <?php 
            $energies_mastered_id = DB::table("energy_mastered")->get(["id_energy", "id_user"])->where("id_user","=",$user->id);
            foreach($energies_mastered_id as $energy_mastered_id){
                $energies_mastered_name = DB::table("energy")->get(["name","id"])->where("id","=",$energy_mastered_id->id_energy);
                foreach($energies_mastered_name as $energy_mastered_name){
                    echo $energy_mastered_name->name;
                    echo "\n";
                }
            }
             ?> </td>
            </tr>
            <?php
        }        
        ?>
        @yield('content')
        </tbody>


        @endsection