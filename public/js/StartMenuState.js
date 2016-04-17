var StartMenuState = function(game,data) {

    this.game = game;
    this.game.data = data;
    console.log("MDF ",data)

};
StartMenuState.prototype.preload = function () {

    //this.game.stage.backgroundColor = '#000000';
    this.game.load.image('timeBonus', 'assets/timeBonus.png');
    this.game.load.image('timeAntiBonus', 'assets/timeAntiBonus.png');
    this.game.load.image('jumpBonus', 'assets/jumpBonus.png');
    this.game.load.image('background', 'assets/start-background.jpg');
    this.game.load.image('play', 'assets/play1.png');

    this.game.load.image('ground', 'assets/land.png');
    this.game.load.image('platform', 'assets/platform.png');
    this.game.load.image('player', DataManager.getPlayerSkin());
    this.game.load.image('points', 'assets/points.png');
    this.game.load.image('coin', 'assets/coin.png');
    this.game.load.image('background', 'assets/background.jpg');
    this.game.load.image('cloud1', 'assets/cloud1.png');
    this.game.load.image('cloud2', 'assets/cloud2.png');
    this.game.load.image('cloud3', 'assets/cloud3.png');
    this.game.load.image('cloud4', 'assets/cloud4.png');
    this.game.load.image('cloud5', 'assets/cloud5.png');
    this.game.load.image('cloud6', 'assets/cloud6.png');
    this.game.load.image('cloud7', 'assets/cloud7.png');
    this.game.load.image('timeBonus', 'assets/timeBonus.png');
    this.game.load.image('jumpBonus', 'assets/jumpBonus.png');
    this.game.load.image('timeAntiBonus', 'assets/timeAntiBonus.png');
    this.game.load.image('shield', 'assets/shield.png');
    this.game.load.image('revive', 'assets/revive1.png');
    this.game.load.audio('jumpSound', 'assets/jump.mp3');
    this.game.load.audio('timeAntiBonusSound', 'assets/timeAntiBonus.mp3');
    this.game.load.audio('timeBonusSound', 'assets/timeBonus.mp3');
    this.game.load.audio('backgroundMusic', 'assets/background-music.mp3');
    this.game.load.audio('coinSound', 'assets/coins-to-table-1.wav');
};
StartMenuState.prototype.create = function () {
    this.backgroundImage = this.game.add.image(0, 0, 'background');
    this.backgroundImage.scale.setTo(0.3, 0.3);

    this.text = this.game.add.text(this.game.world.centerX , this.game.world.centerY - 180, 'Welcome to JUMPY!' + '\n' + 'Climb as high as you can, ' + '\n' + 'before the platfors fall apart!');
    this.text.anchor.set(0.5);
    this.text.align = 'center';

    this.text.font = 'Arial Black';
    this.text.fontSize = 20;
    this.text.fontWeight = 'bold';

    this.text.stroke = '#000000';
    this.text.strokeThickness = 6;
    this.text.fill = '#16a085';


    this.start = this.game.add.image(this.game.world.centerX , this.game.world.centerY + 150, 'play');
    //	Center align
    this.start.anchor.set(0.5);
    this.start.align = 'center';


    this.start.inputEnabled = true;
    this.start.events.onInputDown.add(function () {
        this.game.state.start('game-state');
        console.log('preserd')
    }, this);



    this.timeBonusImage = this.game.add.image(150, this.game.world.centerY - 100 , 'timeBonus');
    this.timeBonusImage.scale.setTo(0.1, 0.1);
    this.style = { font: "18px Ariel", fill: '#2c3e50', fontWeight : '900', tabs: 132 };
    this.timeBonusText = this.game.add.text(220, this.game.world.centerY - 98, 'Collect smilies to slow down' + '\n' + 'platforms destruction!', this.style);


    this.coinImage = this.game.add.image(150, this.game.world.centerY - 40 , 'coin');
    this.coinImage.scale.setTo(0.4, 0.4);
    this.style = { font: "18px Ariel", fill: '#2c3e50', fontWeight : '900', tabs: 132 };
    this.coinText = this.game.add.text(220, this.game.world.centerY - 38, 'Collect coins to' + '\n' + 'buy items from the shop!', this.style);

    this.timeAntiBonusImage = this.game.add.image(150, this.game.world.centerY + 20 , 'timeAntiBonus');
    this.timeAntiBonusImage.scale.setTo(0.1, 0.1);
    this.style = { font: "18px Arielr", fill: '#2c3e50', fontWeight : '900', tabs: 132 };
    this.timeAntiBonusText = this.game.add.text(220, this.game.world.centerY + 30, 'Avoid skulls! They make the' + '\n' + 'lowest 5 platforms disappear!', this.style);

};

StartMenuState.prototype.update = function () {

}