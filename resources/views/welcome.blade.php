@extends('layouts.app')

@section('content')
<div class="table-container">
    <div class="table">
                <div class="table-heading">
                    @if($sortBy == 'currency')
                    <div id="money"></div>
	                    Richest Players
	                @else
                    <div id="trophy"></div>
	                	Top Players
                    @endif
                </div>

                <div class="table-body">

                    <table>
                        <thead>
                        <tr>                     
                            <th>Rank</th>
                            <th>Username</th>	
                            <th><a href="{{route('welcome', ['sortBy' => 'highscore', 'order' => 'DESC'])}}">Score</a></th>
                            <th><a href="{{route('welcome', ['sortBy' => 'currency', 'order' => 'DESC'])}}">Money</a></th>                                                  
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
                        </tbody>                        
                    </table>
                </div>
    </div>
</div>
@endsection
