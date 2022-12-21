@extends('template')
@section('content1')
<div  style = "position: absolute;  width: 800px;  height: 150px;  left:35%;  top: 12px;  background: #D82227;"
  ></div>
<?php 
    $winnerString = "The winner is ". $winner . " ! Congratulations !";
    ?>
<h1 style =" position: absolute; top: 50px; left: 40%; font-family: 'Enriqueta';  font-style: normal; color:#fff">{{$winnerString}}</h1>




@yield('content')