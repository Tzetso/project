@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Shop</div>                
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
			                     	<td>
			                     		<button type="submit" class=".btn-default">Buy</button>
			                     	</td>
			                    </tr>
		               		@endforeach
	                	</tbody>             
	                </table>
            </div>
        </div>
    </div>
</div>
@endsection
