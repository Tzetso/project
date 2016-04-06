var StartMenuState = function(game) {

    this.game = game;

};
StartMenuState.prototype.preload = function () {

    this.game.stage.backgroundColor = '#85b5e1';


};
StartMenuState.prototype.create = function () {

    this.text = this.game.add.text(this.game.world.centerX , this.game.world.centerY - 100, 'ICY TOWER GAME');
    //	Center align
    this.text.anchor.set(0.5);
    this.text.align = 'center';

    //	Font style
    this.text.font = 'Arial Black';
    this.text.fontSize = 50;
    this.text.fontWeight = 'bold';

    //	Stroke color and thickness
    this.text.stroke = '#000000';
    this.text.strokeThickness = 6;
    this.text.fill = '#43d637';


    this.start = this.game.add.text(this.game.world.centerX , this.game.world.centerY + 30, 'START');
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
        this.game.state.start('game-state');
        console.log('preserd')
    }, this);






};
StartMenuState.prototype.update = function () {


};