
<head>
    <title> PokemonStop </title>
    <link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">  
    
 </head>

       
        <tbody>
        <h1> Current player : </h1>
        {{$user1}}
        <h1> Next player : </h1>
        {{$user2}}
        <h3> Current pokemon : </h3>
        {{$poke1Name}}
        <h3> Pv current pokemon : </h3>
        {{$poke1Pv}}

        <form method="POST" action="/doRound">
        {{ csrf_field() }}
            <div class="form-group">
                <input name="Attaque_normale" type="submit" class="button" value="Attaque normale">
            </div>
            
            <div class="form-group">
                <input name="Attaque_speciale" type="submit" class="button" value="Attaque speciale">
            </div>
            
            <div class="form-group">
                <input name="Defense_speciale" type="submit" class="button" value="Defense speciale">
            </div>
        </form>


        </tbody>

    
