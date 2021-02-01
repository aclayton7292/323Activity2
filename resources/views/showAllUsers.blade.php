@extends('layouts.appmaster')
@section('title', 'Login Passed Page')

@section('content')
<!-- action will point to the route -->
    <div class = "container-fluid">   
    <div class= "row justify-content-center">
    	<div class = "col">
    	<table class="table table-dark">
    	<tr><th scope="col">Id</th>
    	<th scope="col">Username</th>
        		@foreach($result as $user)
        		<tr>
        			<td>{{$user->getId()}}</td>
        			<td>{{$user->getUsername()}}</td> 
        			<td>
        			<button type="button" class="btn btn-danger" data-toggle="modal"
							data-target="#deleteUser{{$user->getId()}}">Delete</button>
							<td> 		
        		<!-- The Modal -->
				<div class="modal fade" id="deleteUser{{$user->getId()}}">
					<div class="modal-dialog modal-dialog-centered modal-sm">
						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title"  style="color:black">Delete This User?</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<!-- Modal body -->
							<div class="modal-body" >
								<form method="post" action="deleteUser">
        							<input type = "hidden" name = "id" value = "{{$user->getId()}}">
        							<input type="hidden" name="_token" value="{{ csrf_token()}}"/>
        							<button class="btn btn-danger" type="submit">Delete</button>
        						</form>
							</div>
						</div>
					</div>
				</div>
				
        			</td>     
        		</tr>

        		@endforeach
        </table>
       	</div>
     </div>
    </div>
@endsection