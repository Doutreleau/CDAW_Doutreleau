@extends('template')

@section('content')

    <div  class='rectangleRegisterLogin'></div>

    <h2 style =" position: absolute; top:470px; left: 32%" >Register</h2>

    <form method="POST" action="/register">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" style =" position: absolute; top:550px; left: 32%">Name:</label>
            <input type="text" class="form-control2" id="name" name="name" style =" position: absolute; top:550px; left: 42%; width: 10%">
        </div>

        <div class="form-group">
            <label for="email" style =" position: absolute; top:600px; left: 32%">Email:</label>
            <input type="email" class="form-control2" id="email" name="email" style =" position: absolute; top:600px; left: 42%; width: 10%">
        </div>

        <div class="form-group">
            <label for="password" style =" position: absolute; top:650px; left: 32%">Password:</label>
            <input type="password" class="form-control2" id="password" name="password" style =" position: absolute; top:650px; left: 42%; width: 10%">
        </div>

        <div class="form-group">
            <label for="password_confirmation" style =" position: absolute; top:700px; left: 32%">Password Confirmation:</label>
            <input type="password" class="form-control2" id="password_confirmation" name="password_confirmation" style =" position: absolute; top:700px; left: 42%; width: 10%">
        </div>
        
        <div class="form-group">
            <button style="cursor:pointer; position: absolute; top:750px; left: 32%" type="submit" class="btn btn-primary">Submit</button>
        </div>
        @include('partials.formerrors')
    </form>

@endsection 
 
 
