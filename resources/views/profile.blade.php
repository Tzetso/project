@extends('layouts.app')

@section('content')
        <div class="table-container profile-table-container">
        <div class="table">

            <div class="panel-heading">
            <div class="profile-image-holder">
                <img src="../assets/user-profile-blue.png">
                <p>Profile</p>
            </div>
            </div>
            <div class="panel-body-holder">
                <div class="panel-body">
                     Username : {{$user->username}}
                </div>
                
                <div class="panel-body">
                     Email : {{$user->email}}
                </div>
                
                <div class="panel-body">
                     Highscore : {{$user->highscore}}
                </div>
                
                <div class="panel-body">
                     Money : {{$user->currency}}
                </div>

                <div class="panel-body">
                     Current skin : <img src="{{$avatar->picture}}" alt="No image" />
                </div>

                <div class="panel-body link">
                    <a href="{{ url('/profile/passchange') }}">Change password</a>
                </div>
                
                <div class="panel-body link">
                    <a href="{{ url('/profile/skins') }}">
                    	Change skin
                	</a>
                </div>
                </div>

                <div class="panel-heading inventory">
                            <div class="profile-image-holder">
                                <img src="../assets/inventory.png">
                                <p>Inventory</p>
                            </div>
                            </div>
                <table class="profile-table">
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

@endsection
