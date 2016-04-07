var GameState = function(game) {

    this.game = game;
    this.currentPlatformsCount = 0;
    this.platformArray = [];
    this.points = 0;
    this.timer = {
        t : 3000
    }

    this.dateTimer = null;
    this.timeBonusArray = [];
    this.jumpBonusArray = [];
    this.timeAntiBonus = [];



};
GameState.prototype.preload = function () {

    this.game.stage.backgroundColor = '#85b5e1';

    //this.game.load.baseURL = 'http://examples.phaser.io/assets/';
    this.game.load.crossOrigin = 'anonymous';

    this.game.load.image('ground', 'assets/land.png');
    this.game.load.image('column', 'assets/column.png');
    this.game.load.image('platform', 'assets/platform.png');
    this.game.load.image('player', 'http://examples.phaser.io/assets/sprites/phaser-dude.png');
    this.game.load.image('points', 'assets/points.png');
    this.game.load.image('timeBonus', 'assets/timeBonus.png');
    this.game.load.image('jumpBonus', 'assets/jumpBonus.png');
    this.game.load.image('timeAntiBonus', 'assets/timeAntiBonus.png');
    this.game.load.audio('jumpSound', 'assets/jump.mp3');
    this.game.load.audio('timeAntiBonusSound', 'assets/timeAntiBonus.mp3');
    this.game.load.audio('timeBonusSound', 'assets/timeBonus.mp3');
    this.game.load.audio('backgroundMusic', 'assets/background-music.mp3');
};

//var textStyle = { font: '64px Desyrel', align: 'center'};
//var timer;
//var milliseconds = 0;
//var seconds = 0;
//var minutes = 0;
var tween;

GameState.prototype.create = function () {

    this.dateTimer = Date.now();
    this.game.world.resize(600, 15000);


    this.land = this.game.add.sprite(0,14950,'ground');
    this.land.scale.setTo(1 ,0.7);

    this.leftColumn = this.game.add.sprite(0,0,'column');
    this.rightColumn = this.game.add.sprite(590,0,'column');

    this.rightColumn.fixedToCamera = true;
    this.leftColumn.fixedToCamera = true;

    this.game.physics.arcade.enable(this.leftColumn);
    this.game.physics.arcade.enable(this.rightColumn);
    this.game.physics.arcade.enable(this.land);


    this.rightColumn.body.immovable = true;
    this.leftColumn.body.immovable = true;
    this.land.body.immovable = true;

    this.leftColumn.body.allowGravity = true;
    this.rightColumn.body.allowGravity = true;
    this.land.body.allowGravity = false;



    this.createPlatforms();
    this.createTimeBonuses();
    this.createTimeAntiBonuses();

    this.cursors = this.game.input.keyboard.addKeys( { 'up': Phaser.KeyCode.W, 'down': Phaser.KeyCode.S, 'left': Phaser.KeyCode.A, 'right': Phaser.KeyCode.D } );
    this.jumpButton = this.game.input.keyboard.addKey(Phaser.Keyboard.SPACEBAR);


    for(var i = 0;i < 150; i++){
        this.platformArray[i] = this.platforms.getFirstExists(false);
        var x = this.game.rnd.realInRange(50, 350);
        this.platformArray[i].reset(x,(this.land.y - i*150));
        this.platformArray[i].scale.x = this.game.rnd.realInRange(0.2, 0.4);

    }

    for(var i = 0;i < 10; i++){
        var x = this.game.rnd.realInRange(50, 350);
        var y = this.game.rnd.realInRange(50, 13000);
        var t =  this.timeBonuses.getFirstExists(false).reset(x, y);
        t.scale.setTo(0.2, 0.2);
    }

    for(var i = 0;i < 20; i++){
        var x = this.game.rnd.realInRange(50, 350);
        var y = this.game.rnd.realInRange(50, 13000);
        var t =  this.timeAntiBonuses.getFirstExists(false).reset(x, y);
        t.scale.setTo(0.3, 0.3);
    }

    this.player = this.game.add.sprite(200, 14910, 'player');

    this.game.physics.arcade.enable(this.player);

    this.player.body.collideWorldBounds = false;
    this.player.body.gravity.y = 800;
    this.player.body.bounce.x = 0.6;
    this.player.body.drag.setTo(200);
    this.player.body.drag.x = 100;
    //this.player.isColumn = false;
    this.game.camera.follow(this.player);
    this.killPlatforms();

    this.pointsImage = this.game.add.image(60, 10, 'points');
    this.pointsImage.fixedToCamera = true;
    this.pointsImage.scale.setTo(0.12,0.12)

    var style = { font: "25px Courier", fill: '#FFF', tabs: 132 };

    this.text = this.game.add.text(95, 15, this.points, style);

    this.text.fixedToCamera = true;

    this.jumpSound = this.game.add.audio('jumpSound');
    this.timeAntiBonusSound = this.game.add.audio('timeAntiBonusSound');
    this.timeBonusSound = this.game.add.audio('timeBonusSound');
    this.backgroundMusic = this.game.add.audio('backgroundMusic');

    this.backgroundMusic.play();


};


GameState.prototype.update = function () {

    //this.player.isColumn = false;
    var _this = this;

    this.game.physics.arcade.overlap(this.land, this.platforms, function (land, platform) {
        platform.kill();
    });

    this.game.physics.arcade.collide(this.player, this.platforms);
    this.game.physics.arcade.overlap(this.player, this.timeBonuses, function (player, timeBonus) {
        timeBonus.kill();
        _this.timer.t += 500;
        _this.timeBonusSound.play();
    });

    this.game.physics.arcade.overlap(this.player, this.timeAntiBonuses, function (player, timeAntiBonus) {
        timeAntiBonus.kill();
        _this.timeAntiBonusSound.play();
        _this.timer.t -= 500;
    });

    this.game.physics.arcade.collide(this.player, this.land);
    this.game.physics.arcade.collide(this.player, this.platforms, function(player){
        //player.body.velocity.x = 00;
        //player.body.velocity.y = 00;
        //player.isColumn = true;

    });
    this.game.physics.arcade.collide(this.player, this.rightColumn,function(player){
        //player.body.velocity.x = 00;
        //player.body.velocity.y = 00;
        //player.isColumn = true;

    });

    this.game.physics.arcade.collide(this.player, this.leftColumn,function(player){
        //player.body.velocity.x = 00;
        //player.body.velocity.y = 00;
        //player.isColumn = true;

    });

    //this.player.body.velocity.x = 0;

    if (this.cursors.left.isDown && !this.player.isColumn)
    {
        this.player.body.velocity.x = -250;
    }
    else if (this.cursors.right.isDown && !this.player.isColumn)
    {
        this.player.body.velocity.x = 250;
    }

    if (this.jumpButton.isDown && (this.player.body.onFloor() || this.player.body.touching.down))
    {
        this.jumpSound.play();
        this.player.body.velocity.y = -600;
    }
    var collisionPlayer = false;

    this.game.physics.arcade.overlap(this.player, this.platforms, function (){
        collisionPlayer = true;
    });

    if (this.player.body.position.y < this.player.previousPosition.y) {
        this.points++;
    } else if(this.player.body.position.y > this.player.previousPosition.y) {
        this.points--;
    }

    this.text.setText(this.points);

    //function updateTimer() {
    //    minutes = Math.floor(this.game.time.time / 60000) % 60;
    //    seconds = Math.floor(this.game.time.time / 1000) % 60;
    //    milliseconds = Math.floor(this.game.time.time) % 100;
    //};
    //
    //updateTimer()


};
GameState.prototype.render = function(){
    //try{
    //    this.game.debug.cameraInfo(this.player, 32, 32);
    //} catch(h) {
    //    console.log(h);
    //}


    //var timeText = this.game.add.bitmapText(200, 100, 'desyrel', 'Phaser & Pixi\nrocking!', 32, 32);
    //timeText = 'Elapsed seconds: ' + Math.round(this.game.time.totalElapsedSeconds());
};


GameState.prototype.createPlatforms = function(){

    this.platforms = this.game.add.group();
    this.platforms.enableBody = true;
    this.platforms.physicsBodyType = Phaser.Physics.ARCADE;

    for (var i = 0; i < 150; i++)
    {
        var p = this.platforms.create(0, 0, 'platform');
        this.slidePlatformsTween = this.game.add.tween(p).to({ x: 370 }, 4000, Phaser.Easing.Linear.None, true, 0, 1000, true);
        p.scale.y = 0.5;
        p.name = 'platform' + i;
        p.exists = false;
        p.visible = false;
        p.checkWorldBounds = true;
        p.body.immovable = true;
        p.body.checkCollision.down = false;
        p.body.checkCollision.left = false;
        p.body.checkCollision.right = false;
        p.body.friction.x = 0;
        //console.log(p);
        p.events.onOutOfBounds.add(function(p){
            p.kill();
        }, this);
        if(p.y - this.land.y){
            p.kill();
        }
    }


};

GameState.prototype.createTimeBonuses = function(){

    this.timeBonuses = this.game.add.group();
    this.timeBonuses.enableBody = true;
    this.timeBonuses.physicsBodyType = Phaser.Physics.ARCADE;

    for (var i = 0; i < 150; i++)
    {
        var tB = this.timeBonuses.create(0, 0, 'timeBonus');
        tB.scale.y = 0.5;
        tB.name = 'timeBonus' + i;
        tB.exists = false;
        tB.visible = false;
        tB.checkWorldBounds = true;
        //tB.body.immovable = true;
        //console.log(tB.body);
        tB.events.onOutOfBounds.add(function(tB){
            tB.kill();
        }, this);
        if(tB.y - this.land.y){
            tB.kill();
        }
    }


};

GameState.prototype.createTimeAntiBonuses = function(){

    this.timeAntiBonuses = this.game.add.group();
    this.timeAntiBonuses.enableBody = true;
    this.timeAntiBonuses.physicsBodyType = Phaser.Physics.ARCADE;

    for (var i = 0; i < 150; i++)
    {
        var tAB = this.timeAntiBonuses.create(0, 0, 'timeAntiBonus');
        tAB.scale.y = 0.5;
        tAB.name = 'timeBonus' + i;
        tAB.exists = false;
        tAB.visible = false;
        tAB.checkWorldBounds = true;
        //tAB.body.immovable = true;
        //console.log(tB.body);
        tAB.events.onOutOfBounds.add(function(tAB){
            tAB.kill();
        }, this);
        if(tAB.y - this.land.y){
            tAB.kill();
        }
    }


};



GameState.prototype.killPlatforms = function(){
    var i = null;
    var _this = this;

    function callTimeout(){
        var platform = _this.platforms.getFirstExists();
        platform.alpha = 0;

        _this.game.add.tween(platform).to( { alpha: 1 }, 2000, Phaser.Easing.Linear.None, true, 0, 1000, true);
        i = setTimeout(function(){
            callTimeout();

            if (_this.player.position.y < 14200 && Date.now() - _this.dateTimer > 20000) {

                //console.log(platform);

                platform.kill();

            }
            if (Date.now() - _this.dateTimer > 20000 && _this.player.position.y > _this.platforms.getFirstExists().position.y) {
                console.log(_this.player.position.y > _this.platforms.getFirstExists().position.y);
                _this.killPlayer();

                clearTimeout(i)
            }
            _this.timer.t -= 200;
/*            console.log(_this.player);
            console.log(t);
            console.log(_this.game.time.totalElapsedSeconds());*/
            if (_this.timer.t <= 0){
                _this.timer.t = 1500;
            }

        }, _this.timer.t)
    }


    callTimeout();

};

GameState.prototype.killPlayer = function() {
    this.game.state.start('end-game-state');
    this.game.stats = this.points;
    console.log('GAME OVER');
    this.points = 0;
};

