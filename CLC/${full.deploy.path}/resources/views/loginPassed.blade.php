@extends('layouts.appmaster')
@section('title', 'Login Passed Page')

@section('content')
@if($model->getUsername() == 'Anthony')
<h2>Login Anthony Passed</h2> 
@else
<h2>Login Other Passed</h2>
@endif
<!-- <a href="login2">Try Again</a> -->
@endsection