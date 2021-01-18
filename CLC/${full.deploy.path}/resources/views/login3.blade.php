@extends('layouts.appmaster')
@section('title', 'Login Page')   
    
   @section('content') 
    <form action="dologin3" method = "POST">
        <input type = "hidden" name = "_token"
            value = "<?php echo csrf_token()?>"/>
        <h2>Please Login</h2>

        
        <input type="text" name="username" maxlength="10" /> {{ $errors->first('username') }} </td>
        <input type="password" name="password" maxlength="10" /> {{ $errors->first('password') }} </td>

        <input type = "submit" value = "Ask Now"/>
        
    </form>
    
    <!-- Display all Data Validation Errors -->
        @if($errors->count()!=0)
        	<h5>List of errors</h5>
        	@foreach($errors->all() as $message)
        		{{ $message }} <br/>
        	@endforeach
        @endif
    
    @endsection