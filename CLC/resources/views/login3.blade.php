@extends('layouts.appmaster')
@section('title', 'Login Page')   
    
    @section('content')
<!-- action will point to the route -->
    <div class = "container-fluid">
    <div class = "row justify-content-center">
    <div class = "col-4">
        <form action="dologin3" method = "post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class= "form-group">
            <label for="username">Username:</label>
            <input type="text" class = "form-control" name="username" placeholder = "Enter Username" ></input>
        </div>
        <div class= "form-group">
            <label for="login-password">Password:</label>
            <input type="password" class = "form-control" name="password" placeholder = "Enter Password"></input>
        </div>
            <button class="btn btn-primary" type="submit" name="login" >Login</button>
        </form>
        </div>
        </div>
    </div>
@endsection

  