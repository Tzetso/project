@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

                <div class="panel-body">
                     Username:{{$user->username}}
                </div>
                
                <div class="panel-body">
                     Email:{{$user->email}}
                </div>
                
                <table class=".table-responsive">
                	<thead>
                		<tr>
	                		<th>Name</th>
	                		<th>Description</th>
	                		<th>Price</th>
	                		<th>Quantity</th>
                		</tr>
                	</thead>
                	<tbody>
	                	@foreach($items as $item) 
		                	<tr>
								<td>{{$item->name}}</td>
		                     	<td>{{$item->description}}</td>
		                     	<td>{{$item->price}}</td>
		                     	<td>{{$item->pivot->quantity}}</td>
		                    </tr>
	               		@endforeach
                	</tbody>             
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection
