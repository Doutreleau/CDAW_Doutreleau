
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