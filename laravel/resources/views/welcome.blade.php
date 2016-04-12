@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome 
                	@if($user) 
                		{{ $user->username}}
                	@else                 
                    	Guest
                    @endif
                </div>

                <div class="panel-body">
                    
                    <table class="table">		                
	                	<thead>		                	
	                		<tr>
		                		<th>#</th>
		                		<th><a href="{{route('welcome', ['sortBy' => 'username', 'order' => '$order'])}}">Username</a></th>
		                		<th><a href="{{route('welcome', ['sortBy' => 'highscore', 'order' => '$order'])}}">Score</a></th>
		                		<th><a href="{{route('welcome', ['sortBy' => 'currency', 'order' => '$order'])}}">Money</a></th>
	                		</tr>		                		
	                	</thead>
	                	
	                	<tbody>
	                    	@foreach($users as $user)
		                		<tr>
		                			<td>{{ $count++ }}</td>
									<td>{{$user->username}}</td>
		                    	 	<td>{{$user->highscore}}</td>	
		                    	 	<td>{{$user->currency}}</td>                       	
		                  	  	</tr>
	               			@endforeach
	               			{!! $users->render() !!}
                    	</tbody>     		                	        
		           	</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
