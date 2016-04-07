var StartMenuState = function(game) {

    this.game = game;

};
StartMenuState.prototype.preload = function () {

    this.game.stage.backgroundColor = '#000000';
    this.game.load.image('timeBonus', 'http://localhost:63342/Phaser-Game/assets/timeBonus.png');
    this.game.load.image('timeAntiBonus', 'http://localhost:63342/Phaser-Game/assets/timeAntiBonus.png');
    this.game.load.image('jumpBonus', 'http://localhost:63342/Phaser-Game/assets/jumpBonus.png');


};
StartMenuState.prototype.create = function () {

    this.text = this.game.add.text(this.game.world.centerX , this.game.world.centerY - 180, 'Welcome to JUMPY!' + '\n' + 'Climb as high as you can, ' + '\n' + 'before the platfors fall apart!');
    this.text.anchor.set(0.5);
    this.text.align = 'center';

    this.text.font = 'Arial Black';
    this.text.fontSize = 20;
    this.text.fontWeight = 'bold';

    this.text.stroke = '#000000';
    this.text.strokeThickness = 6;
    this.text.fill = '#43d637';


    this.start = this.game.add.text(this.game.world.centerX , this.game.world.centerY + 150, 'PLAY');
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

    this.timeBonusImage = this.game.add.image(150, this.game.world.centerY - 100 , 'timeBonus');
    this.timeBonusImage.scale.setTo(0.5, 0.5);
    this.style = { font: "15px Courier", fill: '#FF8000', fontWeight : 'bold', tabs: 132 };
    this.timeBonusText = this.game.add.text(220, this.game.world.centerY - 90, 'Collect smilies to slow down' + '\n' + 'platforms destruction!', this.style);


    this.jumpBonusImage = this.game.add.image(150, this.game.world.centerY - 40 , 'jumpBonus');
    this.jumpBonusImage.scale.setTo(0.5, 0.5);
    this.style = { font: "15px Courier", fill: '#FF8000', fontWeight : 'bold', tabs: 132 };
    this.jumpBonusText = this.game.add.text(220, this.game.world.centerY - 30, 'Collect jump bonuses to' + '\n' + 'jump higher for 10 sec!', this.style);

    this.timeAntiBonusImage = this.game.add.image(150, this.game.world.centerY + 20 , 'timeAntiBonus');
    this.timeAntiBonusImage.scale.setTo(0.5, 0.5);
    this.style = { font: "15px Courier", fill: '#FF8000', fontWeight : 'bold', tabs: 132 };
    this.timeAntiBonusText = this.game.add.text(220, this.game.world.centerY + 30, 'Avoid skulls! They make platforms' + '\n' + 'disappear faster for 10 sec!', this.style);

};

StartMenuState.prototype.update = function () {

}