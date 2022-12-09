@extends('template')
@section('content1')

    <img class='loginPageShape'  src = 'assets/img/shape3.png' style="position: absolute; top:200px"></img>
    <h2 style =" position: absolute; top:300px; left: 32%" >Log in of a second user</h2>

    <form method="POST" action="/loginSecondUser">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email" style =" position: absolute; top:380px; left: 32%" >Email:</label>
            <input type="email" class="form-control" id="email" name="email" style =" position: absolute; top:380px; left: 42%; width: 10%">
        </div>

        <div class="form-group">
            <label for="password" style =" position: absolute; top:430px; left: 32%">Password:</label>
            <input type="password" class="form-control" id="password" name="password" style =" position: absolute; top:430px; left: 42%; width: 10%">
        </div>

        <div class="form-group">
            <button style="cursor:pointer; position: absolute; top:560px; left: 32%" type="submit" class="btn btn-primary">Login</button>
        </div>

        <div class="form-group">
            <label style =" position: absolute; top:500px; left: 32%">Mode:</label>
            <select name="mode" onChange="combo(this, 'box)" style =" position: absolute; top:500px; left: 42%; width: 10%">
            <option value="manuel">Manuel et tour par tour</option>
            <option value = "aleatoire automatique">Aléatoire automatique</option>
            <option value = "aleatoire tour par tour">Aléatoire et tour par tour</option>
            </select>
        </div>
        @include('partials.formerrors')
    </form>

    @endsection