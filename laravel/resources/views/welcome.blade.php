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
                            <th><a href="{{route('welcome', ['sortBy' => 'username', 'order' => '$order'])}}">Username</a></th>
                            <th><a href="{{route('welcome', ['sortBy' => 'highscore', 'order' => '$order'])}}">Score</a></th>
                            <th><a href="{{route('welcome', ['sortBy' => 'currency', 'order' => '$order'])}}">Money</a></th>
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
                    <div>{!! $users->render() !!}</div>
                </div>
    </div>
</div>
@endsection
