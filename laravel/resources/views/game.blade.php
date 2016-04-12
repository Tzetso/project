@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-fluid">
        <div id="game">
        </div>
    </div>
</div>
	<script type="text/javascript" src="/node_modules/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="/node_modules/phaser/dist/phaser.js"></script>
	<script type="text/javascript" src="/js/DataMng.js"></script>
	<script type="text/javascript" src="/js/StartMenuState.js"></script>
	<script type="text/javascript" src="/js/GameState.js"></script>
	<script type="text/javascript" src="/js/GameOver.js"></script>
	<script type="text/javascript" src="/js/game.js"></script>	
@endsection
