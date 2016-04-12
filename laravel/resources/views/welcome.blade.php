@extends('layouts.app')

@section('content')
<div class="table-container">
    <div class="table">
                <div class="table-heading">Welcome
                    @if($user)
                    {{ $user->username}}
                    @else
                    Guest
                    @endif
                </div>

                <div class="table-body">

                    <table>
                        <thead>
                        <tr>
                     
                            <th>#</th>
                            @if($sortBy == 'username')
                            	<th><a href="{{route('welcome', ['sortBy' => 'username', 'order' => ($order == 'ASC' ? 'DESC' : 'ASC')])}}">Username</a></th>
                            @else	
                            	<th><a href="{{route('welcome', ['sortBy' => 'username', 'order' => 'ASC'])}}">Username</a></th>
                            @endif
                            @if($sortBy == 'highscore')
                            	<th><a href="{{route('welcome', ['sortBy' => 'highscore', 'order' => ($order == 'ASC' ? 'DESC' : 'ASC')])}}">Score</a></th>
                            @else	
                            	<th><a href="{{route('welcome', ['sortBy' => 'highscore', 'order' => 'DESC'])}}">Score</a></th>
                            @endif
                            @if($sortBy == 'currency')
                            	<th><a href="{{route('welcome', ['sortBy' => 'currency', 'order' => ($order == 'ASC' ? 'DESC' : 'ASC')])}}">Money</a></th>
                            @else	
                            	<th><a href="{{route('welcome', ['sortBy' => 'currency', 'order' => 'DESC'])}}">Money</a></th>
                            @endif
                            
                         
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
