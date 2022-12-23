@extends('template')
@section('content1')
    <link rel="stylesheet" href="css/styles.css" crossorigin="anonymous">


    <img class='loginPageShape'  style =" position: absolute; top:180px; " src = 'assets/img/shape3.png'></img>

    <a style =" position: absolute; top:300px; left: 32%;font-family: 'Enriqueta'; font-style: normal;  font-weight: 500;  font-size: 40px; line-height: 27px;  color: #000000;" href = "/namechange"> Change Name </a>
    <a style =" position: absolute; top:400px; left: 32%;font-family: 'Enriqueta'; font-style: normal;  font-weight: 500;  font-size: 40px; line-height: 27px;  color: #000000;" href = "/mailchange"> Change Mail </a>
    <a style =" position: absolute; top:500px; left: 32%;font-family: 'Enriqueta'; font-style: normal;  font-weight: 500;  font-size: 40px; line-height: 27px;  color: #000000;"href = "/passwordchange"> Change Password </a> 
    
    @endsection

