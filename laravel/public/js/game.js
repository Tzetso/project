/**
 * Created by User on 1.4.2016 г..
 */
var Icy_tower = function () {



    var game = new Phaser.Game(640  , 480 , Phaser.CANVAS, 'game');
    var startMenuState = null;
    var gameState = null;
    var endGameState = null;
    DataManager.getHightScore(function(data){
        startMenuState = new StartMenuState(game,data);
        game.state.add('start-menu', startMenuState, false);
        game.state.start('start-menu');
    });

    gameState = new GameState(game);
    game.state.add('game-state', gameState, false);

    endGameState = new GameOverMenuState(game);
    game.state.add('end-game-state', endGameState, false);

    /*return {
        init:function () {
            game.state.start('start-menu');
        }

    }*/


}();

/*Icy_tower.init();*/
