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
    <h3 style =" position: absolute; top:20px; left: 310px">Enter the id of the match you want to replay</h3>
    <form method="POST" action="/replayMatch">
        {{ csrf_field() }}
        <input style =" position: absolute; top:60px; left: 310px"  type="text" placeholder="Enter the id of the match you want to replay" name="matchId">
        <div class="form-group">
            <button style="cursor:pointer;position: absolute; top:100px; left: 310px" type="submit" class="btn btn-primary">Choose match</button>
        </div>
    </form>

    <table id="Pokedex", class="display">
        <thead>
        <tr>
            <th>Id</th>
            <th>Mode</th>
            <th>User 1</th>
            <th>User 2</th>
        </tr>
        </thead>
        <tbody>

        <?php 
        foreach ($matches as $match) {
            ?>
           <tr>
            <td> <?php echo $match->id; ?> </td>
            <td> <?php echo $match->mode; ?> </td>
           
            <td> <?php 
            $users1 = DB::table("users")->where("id","=",$match->id_user1)->get(["name"]);
            foreach($users1 as $user1){
                echo $user1->name;
            }
             ?> </td>

            <td> <?php 
            $users2 = DB::table("users")->where("id","=",$match->id_user2)->get(["name"]);
            foreach($users2 as $user2){
                echo $user2->name;
            }
             ?> </td>
            </tr>
            <?php
        }        
        ?>
        @yield('content')
        </tbody>


        @endsection