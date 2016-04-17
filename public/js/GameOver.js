var GameOverMenuState = function(game) {

    this.game = game;

};
GameOverMenuState.prototype.preload = function () {

    this.game.stage.backgroundColor = '#000000';


};
GameOverMenuState.prototype.create = function () {
    this.game.world.resize(640, 480);
    //console.log(this.game);
    //console.log(this);
    var style = { font: "20px Courier", fill: "#fff", tabs: 132 };

    this.text = this.game.add.text(this.game.world.centerX , this.game.world.centerY - 100, 'GAME OVER '+ '\n' + 'Your score: ' + this.game.stats + '\n' + 'Coins collected: ' + this.game.coinsCollected);

    //this.text = this.game.add.text(this.game.world.centerX , this.game.world.centerY - 100, 'GAME OVER');
    ////	Center align
    this.text.anchor.set(0.5);
    this.text.align = 'center';
    this.text.fixedToCamera = true;

    //	Font style
    this.text.font = 'Arial Black';
    this.text.fontSize = 40;
    this.text.fontWeight = 'bold';

    //	Stroke color and thickness
    this.text.stroke = '#000000';
    this.text.strokeThickness = 6;
    this.text.fill = '#43d637';


    this.start = this.game.add.text(this.game.world.centerX , this.game.world.centerY + 100, 'TRY AGAIN');
    //	Center align
    this.start.anchor.set(0.5);
    this.start.align = 'center';

    //	Font style
    this.start.font = 'Arial Black';
    this.start.fontSize = 70;
    this.start.fontWeight = 'bold';

    //	Stroke color and thickness
    this.start.stroke = '#000000';
    this.start.strokeThickness = 6;
    this.start.fill = '#a4145d';
    this.start.inputEnabled = true;
    this.start.events.onInputDown.add(function () {
        this.game.state.start('game-state', true, false);
        console.log('GAME OVER')
    }, this);

};
GameOverMenuState.prototype.update = function () {


};