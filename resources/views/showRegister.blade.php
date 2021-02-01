@extends('layouts.appmaster')
@section('head','Sign Up')
@section('title')
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
@endsection
@section('content')

    <div class = "container-fluid">
    <div class = "row justify-content-center">
    <div class = "col-4">  
<form action="doRegister" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>    
    <div class="form-group">
		<label for="username"><b>Username:</b></label>
    	<input type="text"class = "form-control" placeholder="Enter your first name" name="username" >
    </div>
    <div class="form-group">
   		<label for="password"><b>Password:</b></label>
    	<input type="password"class = "form-control" placeholder="Enter your password" name="password" >
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
  </div>
  </div>
  </div>

@endsection