@extends('layouts.app')

@section('content')
<div class="table-container">
    <div class="table">
	            	<div class="panel-heading skins">Skins</div>
	            	<form action="" method="post" class="skins-table">
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
@endsection
