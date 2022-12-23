@extends('template')
@section('content1')

<img class='loginPageShape'  style =" position: absolute; top:180px; " src = 'assets/img/shape3.png'></img>

<h2 style =" position: absolute; top:300px; left: 32%" >Change password</h2>

<form method="POST" action="/passwordchange">
    {{ csrf_field() }}
    <div class="form-group">
        <label style =" position: absolute; top:380px; left: 32%" >New password:</label>
        <input class="form-control" name="newPassword" style =" position: absolute; top:380px; left: 42%; width: 10%">
    </div>

    <div class="form-group">
        <label for="password" style =" position: absolute; top:450px; left: 32%">Current password:</label>
        <input type="password" class="form-control" id="password" name="password" style =" position: absolute; top:450px; left: 42%; width: 10%">
    </div>

    <div class="form-group">
        <button style="cursor:pointer; position: absolute; top:550px; left: 32%" type="submit" class="btn btn-primary">Change Password</button>
    </div>
</form>
@endsection

