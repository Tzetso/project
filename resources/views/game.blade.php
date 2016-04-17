@extends('layouts.app')

@section('content')
<div id="game-container">
    <div id="game-div">
        <div id="game">
        
        </div>
        <div id="game-controls">
            <div class="control">
                <img src="assets/space.png" alt="">
                Jump
            </div>
            <div class="control">
                <img src="assets/button-a.png" alt="">
                Move left
            </div>
            <div class="control">
                <img src="assets/button-d.png" alt="">
                Move right
            </div>
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
<!-- <script type="text/javascript" src="node_modules/phaser/dist/phaser.js"></script>
<script type="text/javascript" src="js/StartMenuState.js"></script>
<script type="text/javascript" src="js/GameState.js"></script>
<script type="text/javascript" src="js/GameOver.js"></script>
<script type="text/javascript" src="js/game.js"></script> -->
@endsection
