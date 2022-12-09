@extends('template')
@section('content1')



    <div class='userPageRect1'></div>
    <div class='userPageRect2'></div>
    <div class='userPageLevel'>Level : {{ intdiv(auth()->user()->nb_victories,10) }} </div>
    <a class='userPageEnergies' href="#">Energies mastered :
        <?php
                foreach($energiesNames as $energyName){
                echo $energyName->name;
                echo "\r\n";
            }
        
        
        ?></a>
        

    <div  class='rectLoginRegister'></div>
    <img class='registerShape' src = 'assets/img/shape2.png'></div>
    <a class='registerText' href="/param">Parameters</a>
    <img class='loginShape' src = 'assets/img/shape1.png'></div>
    <a class='loginText' href="/logout">Log out</a>
    
    <img class='userPageBattleShape' src = 'assets/img/shape2.png'>></img>
    <img class='userPageBattleImage'  src = 'assets/img/battle.png'></img>
    <a class='userPageBattleText' href="/choiceSecondUser"> Start a battle</a>
    
    @if( auth()->check() )
        <li class="nav-item">
            <h3 class='userPageHello' href="#">Hi {{ auth()->user()->name }} !</h3>
        </li>
    @endif

@endsection

