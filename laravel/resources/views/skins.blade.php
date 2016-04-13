@extends('layouts.app')

@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
	            	<div class="panel-heading">Skins</div>
	            	<form action="" method="post">
		            	{!! csrf_field() !!}   
			            {{ method_field('PATCH')}}
			              
		 				@foreach($skins as $skin)
		 					<div>
		 						<img src="../{{$skin->picture}}" alt="No image" />
		 						{{$skin->name}}
		 						@if($skin->id == $avatar->id)
		 							<input type="radio" name="skin" value="{{$skin->id}}" checked="true">
		 						@else
		 							<input type="radio" name="skin" value="{{$skin->id}}">
		 						@endif
		 					</div>
		 				@endforeach
		 				
		 				<button type="submit" class=".btn-default">Save</button>  
		 			</form>          
	            </div>
	        </div>
	    </div>
	</div>
@endsection
