@extends('template')
@section('content1')

<img class='loginPageShape'  style =" position: absolute; top:180px; " src = 'assets/img/shape3.png'></img>

<h2 style =" position: absolute; top:300px; left: 32%" >Change mail</h2>

<form method="POST" action="/mailchange">
    {{ csrf_field() }}
    <div class="form-group">
        <label style =" position: absolute; top:380px; left: 32%" >New mail:</label>
        <input class="form-control" name="newMail" style =" position: absolute; top:380px; left: 42%; width: 10%">
    </div>

    <div class="form-group">
        <label for="password" style =" position: absolute; top:450px; left: 32%">Password:</label>
        <input type="password" class="form-control" id="password" name="password" style =" position: absolute; top:450px; left: 42%; width: 10%">
    </div>

    <div class="form-group">
        <button style="cursor:pointer; position: absolute; top:550px; left: 32%" type="submit" class="btn btn-primary">Change mail</button>
    </div>
</form>


@endsection

