@extends('layouts.app')

@section('content')
	<div class="container">
	
	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">	        
	            <div class="panel panel-default">	            
	                <div class="panel-heading">Shop</div>
	                
	                <form class="form-horizontal" role="form" method="POST" action="">    
	                	{!! csrf_field() !!}   
	                	{{ method_field('PATCH')}}       
	                	
		                <table class=".table-responsive">
		                
		                	<thead>		                	
		                		<tr>
			                		<th>Name</th>
			                		<th>Description</th>
			                		<th>Price</th>
		                		</tr>		                		
		                	</thead>
		                	
		                	<tbody>
			                	@foreach($items as $item)
				                	<tr>
										<td>{{$item->name}}</td>
				                     	<td>{{$item->description}}</td>
				                     	<td>{{$item->price}}</td>
				                     	@if($money >= $item->price)
					                     	<td>
					                     		<button name="button" value="{{$item->id}}" type="submit" class=".btn-default">Buy</button>
					                     	</td>
					                    @endif
				                    </tr>
			               		@endforeach
		                	</tbody>     
		                	        
		                </table>
		             </form>
	 
	            </div>
	        </div>
	    </div>
	</div>
@endsection
