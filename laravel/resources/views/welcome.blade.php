@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                	@if($user) 
                		Sup {{ $user->username}}
                	@else                 
                    	Sup guest
                    @endif
                    
                    <table class=".table-responsive">		                
	                	<thead>		                	
	                		<tr>
		                		<th>#</th>
		                		<th>Name</th>
		                		<th>Score</th>
	                		</tr>		                		
	                	</thead>
	                	
	                	<tbody>
                    @foreach($users as $user)
	                	<tr>
	                		<td>{{++$count}}</td>
							<td>{{$user->username}}</td>
	                     	<td>{{$user->highscore}}</td>	                     	
	                    </tr>
               		@endforeach
                    	</tbody>     
		                	        
		           	</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
