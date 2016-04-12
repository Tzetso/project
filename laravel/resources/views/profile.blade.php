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
                
                <div class="panel-body">
                     Highscore:{{$user->highscore}}
                </div>
                
                <div class="panel-body">
                     Money:{{$user->currency}}
                </div>
                
                <div class="panel-body">
                   	Skin: <img src="{{$avatar->picture}}" alt="No image" /> 
                    <a href="{{ url('/profile/skins') }}">
                    	Change skin
                	</a>
                </div>
                
                <table class=".table-responsive">
                	<thead>
                		<tr>
	                		<th>Picture</th>
	                		<th>Name</th>
	                		<th>Quantity</th>
                		</tr>
                	</thead>
                	<tbody>
	                	@foreach($items as $item) 
		                	<tr>
								<td><img src="{{$item->picture}}" alt="No image" /></td>
		                     	<td>{{$item->name}}</td>
		                     	<td>{{$user->items->find($item->id)->pivot->quantity}}</td>
		                    </tr>
	               		@endforeach
                	</tbody>             
                </table>
                
            </div>
        </div>
    </div>
</div>
@endsection
