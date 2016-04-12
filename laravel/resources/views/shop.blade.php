@extends('layouts.app')

@section('content')
    <div class="table-container">
        <div class="table">
	                <form class="form-horizontal" role="form" method="POST" action="">    
	                	{!! csrf_field() !!}   
	                	{{ method_field('PATCH')}}       
	                	<div class="table-heading"></div>
	                	<div class="table-body">
                            <table>

                                <thead>
                                    <tr>
                                        <th>Picture</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Money:{{$money}}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td><img src="{{$item->picture}}" alt="Image didn't load"/></td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->description}}</td>
                                            <td>{{$item->price}}</td>
                                            @if($money >= $item->price)
                                                <td>
                                                    <button name="button" value="{{$item->id}}" type="submit" class=".btn-default">Buy</button>
                                                </td>
                                            @else
                                                <td>Not enough cash</td>
                                            @endif
                                        </tr>
                                    @endforeach

                                    @foreach($skins as $skin)
                                        <tr>
                                            <td><img src="{{$skin->picture}}" alt="Image didn't load"/></td>
                                            <td>{{$skin->name}}</td>
                                            <td>{{$skin->description}}</td>
                                            <td>{{$skin->price}}</td>
                                            @if($money >= $skin->price)
                                                <td>
                                                    <button name="button" value="{{$skin->id}}" type="submit">Buy</button>
                                                </td>
                                            @else
                                                <td>Not enough cash</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
		                 </div>
		             </form>
		</div>
    </div>
@endsection
