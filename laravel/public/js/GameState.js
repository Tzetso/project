var GameState = function(game) {

    this.game = game;
    this.currentPlatformsCount = 0;
    this.platformArray = [];
    this.points = 0;
    this.coinsQuant = 0;
    this.timer = {
        t : 3000
    }
    this.cloudsArray = ['cloud1', 'cloud2', 'cloud3', 'cloud4', 'cloud5', 'cloud6', 'cloud7' ];

    this.dateTimer = null;
    this.playerPosition = 29910;
    this.platformsLeft = 0;

};
GameState.prototype.preload = function () {

    this.game.stage.backgroundColor = '#85b5e1';

    //this.game.load.baseURL = 'http://examples.phaser.io/assets/';
    this.game.load.crossOrigin = 'anonymous';

};

//var textStyle = { font: '64px Desyrel', align: 'center'};
//var timer;
//var milliseconds = 0;
//var seconds = 0;
//var minutes = 0;
var tween;

GameState.prototype.create = function () {
    this.background = this.game.add.image(0, 0, 'background');
    this.background.fixedToCamera = true;


    this.dateTimer = Date.now();
    this.game.world.resize(600, 30000);


    this.land = this.game.add.sprite(-50,29950,'ground');
    this.land.scale.setTo(1 ,1);

  /*  this.leftColumn = this.game.add.sprite(0,0,'column');
    this.rightColumn = this.game.add.sprite(590,0,'column');

    this.rightColumn.fixedToCamera = true;
    this.leftColumn.fixedToCamera = true;

    this.game.physics.arcade.enable(this.leftColumn);
    this.game.physics.arcade.enable(this.rightColumn);
  */  this.game.physics.arcade.enable(this.land);


    //this.rightColumn.body.immovable = true;
    //this.leftColumn.body.immovable = true;
    this.land.body.immovable = true;

    //this.leftColumn.body.allowGravity = true;
    //this.rightColumn.body.allowGravity = true;
    this.land.body.allowGravity = false;


    this.createClouds();
    this.createPlatforms();
    this.createTimeBonuses();
    this.createTimeAntiBonuses();
    this.createCoins();



    this.cursors = this.game.input.keyboard.addKeys( { 'up': Phaser.KeyCode.W, 'down': Phaser.KeyCode.S, 'left': Phaser.KeyCode.A, 'right': Phaser.KeyCode.D } );
    this.jumpButton = this.game.input.keyboard.addKey(Phaser.Keyboard.SPACEBAR);

    for(var i = 0;i < 500; i++){
        var x = this.game.rnd.realInRange(-200, 450);
        var y = this.game.rnd.realInRange(50, 29500);
        var c =  this.clouds.getFirstExists(false).reset(x, y);
        c.scale.setTo(this.game.rnd.realInRange(0.2, 1));
    }

    for(var i = 0;i < 300; i++){
        this.platformArray[i] = this.platforms.getFirstExists(false);
        var x = this.game.rnd.realInRange(-50, 400);
        this.platformArray[i].reset(x,(this.land.y - i*150));
        this.platformArray[i].scale.x = this.game.rnd.realInRange(0.2, 0.4);
        this.randCoordinates = Math.floor(Math.random() * 450);
        this.slidePlatformsTween = this.game.add.tween(this.platformArray[i]).to({ x: this.randCoordinates }, 1500, Phaser.Easing.Linear.None, true, 0, 1000, true);
    }

    for(var i = 0;i < 10; i++){
        var x = this.game.rnd.realInRange(0, 350);
        var y = this.game.rnd.realInRange(50, 29500);
        var t =  this.timeBonuses.getFirstExists(false).reset(x, y);
        t.scale.setTo(0.1, 0.1);
    }

    for(var i = 0;i < 30; i++){
        var x = this.game.rnd.realInRange(0, 350);
        var y = this.game.rnd.realInRange(50,29500);
        var t =  this.timeAntiBonuses.getFirstExists(false).reset(x, y);
        t.scale.setTo(0.08, 0.08);
    }

    for(var i = 0;i < 50; i++){
        var x = this.game.rnd.realInRange(0, 350);
        var y = this.game.rnd.realInRange(50,29500);
        var c =  this.coins.getFirstExists(false).reset(x, y);
        c.scale.setTo(0.3, 0.3);
    }

    this.player = this.game.add.sprite(200, 29910, 'player');

    this.game.physics.arcade.enable(this.player);

    this.player.body.collideWorldBounds = true;
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

    this.coinsImage = this.game.add.image(265, 10, 'coin');
    this.coinsImage.fixedToCamera = true;
    this.coinsImage.scale.setTo(0.23,0.23)

    var style = { font: "25px Courier", fill: '#FFF', tabs: 132 };

    this.text = this.game.add.text(95, 15, this.points, style);
    this.text.fixedToCamera = true;

    this.coinText = this.game.add.text(300, 15, this.coinsQuant, style);
    this.coinText.fixedToCamera = true;

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

    this.game.physics.arcade.overlap(this.player, this.coins, function (player, coin) {
        coin.kill();
        _this.coinsQuant += 50;
    });

    this.game.physics.arcade.overlap(this.player, this.timeAntiBonuses, function (player, timeAntiBonus) {
        timeAntiBonus.kill();
        _this.timeAntiBonusSound.play();
        _this.platforms.getFirstExists().kill();
        _this.platforms.getFirstExists().kill();
        _this.platforms.getFirstExists().kill();
        _this.platforms.getFirstExists().kill();
        _this.platforms.getFirstExists().kill();
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

    if (this.player.body.position.y < this.playerPosition && this.player.body.touching.down) {
        this.playerPosition = this.player.body.position.y;
        this.points+=20;
    } else {
        this.points += 0;
    }


    this.text.setText(this.points);
    this.coinText.setText(this.coinsQuant);

};
GameState.prototype.render = function(){
    //try{
    //    this.game.debug.cameraInfo(this.player, 32, 32);
    //} catch(h) {
    //    console.log(h);
    //}

};


GameState.prototype.createPlatforms = function(){

    this.platforms = this.game.add.group();
    this.platforms.enableBody = true;
    this.platforms.physicsBodyType = Phaser.Physics.ARCADE;

    for (var i = 0; i < 300; i++)
    {
        var p = this.platforms.create(0, 0, 'platform');

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


GameState.prototype.createClouds = function(){

    this.clouds = this.game.add.group();
    var cloudImageIndex = null;
    for (var i = 0; i < 500 ; i++) {
        cloudImageIndex = parseInt(Math.random() * (this.cloudsArray.length - 1))
        var cloud = this.clouds.create(0, 0, this.cloudsArray[cloudImageIndex]);
        cloud.scale.y = 0.5;
        cloud.name = 'cloud' + i;
        cloud.exists = false;
        cloud.visible = true;

        cloud.events.onOutOfBounds.add(function(tB){
            cloud.kill();
        }, this);
        if(cloud.y - this.land.y){
            cloud.kill();
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
        tB.body.checkCollision.down = false;
        tB.body.checkCollision.up = false;
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

GameState.prototype.createCoins = function(){

    this.coins = this.game.add.group();
    this.coins.enableBody = true;
    this.coins.physicsBodyType = Phaser.Physics.ARCADE;

    for (var i = 0; i < 150; i++)
    {
        var cn = this.coins.create(0, 0, 'coin');
        cn.scale.y = 0.5;
        cn.name = 'coin' + i;
        cn.exists = false;
        cn.visible = false;
        cn.body.checkCollision.down = false;
        cn.body.checkCollision.up = false;
        cn.events.onOutOfBounds.add(function(cn){
            cn.kill();
        }, this);
        if(cn.y - this.land.y){
            cn.kill();
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
        tAB.scale.y = 0.4;
        tAB.name = 'timeBonus' + i;
        tAB.exists = false;
        tAB.visible = false;
        tAB.body.checkCollision.down = false;
        tAB.body.checkCollision.up = false;
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

            if (_this.player.position.y < 29800 && Date.now() - _this.dateTimer > 10000) {

                //console.log(platform);

                platform.kill();

            }
            if (Date.now() - _this.dateTimer > 5000 && _this.player.position.y > _this.platforms.getFirstExists().position.y) {
                //console.log(_this.player.position.y > _this.platforms.getFirstExists().position.y);
                _this.killPlayer();

                clearTimeout(i)
            }
            _this.timer.t -= 500;
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
<<<<<<< HEAD
    if(DataManager.getInternalData() < this.points){

        DataManager.postHighscore(this.points, this.coinsQuant);
=======
    
    if(DataManager.getInternalData() < this.points){

    	DataManager.postHighscore(this.points, this.coinsQuant);
>>>>>>> 378da3b4a2132fc2bbf144251526b35350c10357
        console.log(this.points, this.coinsQuant);
    }else{
    	DataManager.postCoins(this.coinsQuant);
    	console.log(this.coinsQuant);
<<<<<<< HEAD
=======

>>>>>>> 378da3b4a2132fc2bbf144251526b35350c10357
    }
    this.game.coinsCollected = this.coinsQuant;
    console.log('GAME OVER');
    this.points = 0;
    this.coinsQuant = 0;
};

