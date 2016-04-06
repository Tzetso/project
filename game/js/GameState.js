var GameState = function(game) {

    this.game = game;
    this.currentPlatformsCount = 0;
    this.platformArray = [];
    this.points = 0;
    this.timer = null;

};
GameState.prototype.preload = function () {

    this.game.stage.backgroundColor = '#85b5e1';

    this.game.load.baseURL = 'http://examples.phaser.io/assets/';
    this.game.load.crossOrigin = 'anonymous';


    this.game.load.image('column', 'http://localhost:63342/Phaser-Game/assets/column.png');
    this.game.load.image('platform', 'sprites/platform.png');
    this.game.load.image('player', 'sprites/phaser-dude.png');
    this.game.load.image('points', 'http://localhost:63342/Phaser-Game/assets/points.png');
};

//var textStyle = { font: '64px Desyrel', align: 'center'};
//var timer;
//var milliseconds = 0;
//var seconds = 0;
//var minutes = 0;
var tween;

GameState.prototype.create = function () {

    this.timer = Date.now();
    this.game.world.resize(600, 15000);


    this.land = this.game.add.sprite(0,14950,'platform');
    this.land.scale.setTo(1.2,1);

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

    this.cursors = this.game.input.keyboard.addKeys( { 'up': Phaser.KeyCode.W, 'down': Phaser.KeyCode.S, 'left': Phaser.KeyCode.A, 'right': Phaser.KeyCode.D } );
    this.jumpButton = this.game.input.keyboard.addKey(Phaser.Keyboard.SPACEBAR);


    for(var i = 0;i < 150; i++){
        this.platformArray[i] = this.platforms.getFirstExists(false);
        var x = this.game.rnd.realInRange(1, 300);
        this.platformArray[i].reset(x,(this.land.y - i*150));
        this.platformArray[i].scale.x = this.game.rnd.realInRange(0.2, 0.4);
    }

    this.player = this.game.add.sprite(200, 14910, 'player');

    this.game.physics.arcade.enable(this.player);

    this.player.body.collideWorldBounds = false;
    this.player.body.gravity.y = 500;
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


};


GameState.prototype.update = function () {

    //this.player.isColumn = false;

    this.game.physics.arcade.collide(this.player, this.platforms);
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
        this.player.body.velocity.y = -500;
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
        p.scale.y = 0.5;
        p.name = 'platform' + i;
        p.exists = false;
        p.visible = false;
        p.checkWorldBounds = true;
        p.body.immovable = true;
        p.body.checkCollision.down = false;
        p.body.friction.x = 0;
        //console.log(p.body);
        p.events.onOutOfBounds.add(function(p){
            p.kill();
            console.log('New Platform')
        }, this);
        if(p.y - this.land.y){
            p.kill();
        }
    }


};
GameState.prototype.killPlatforms = function(){
    var t = 3000;
    var i = null;
    var _this = this;

    function callTimeout(){

        i = setTimeout(function(){
            callTimeout();

            if (_this.player.position.y < 14200 && _this.game.time.totalElapsedSeconds() > 20) {
                var platform = _this.platforms.getFirstExists();
                console.log(platform);
                platform.kill();

            }
            if (Date.now() - _this.timer > 20000 && _this.player.position.y > _this.platforms.getFirstExists().position.y) {
                console.log(_this.player.position.y > _this.platforms.getFirstExists().position.y);
                _this.killPlayer();

                clearTimeout(i)
            }
            t -= 200;
/*            console.log(_this.player);
            console.log(t);
            console.log(_this.game.time.totalElapsedSeconds());*/
            if (t <= 0){
                t = 1500;
            }

        }, t)
    }


    callTimeout();

};

GameState.prototype.killPlayer = function() {
    this.game.state.start('end-game-state');
    this.game.stats = this.points;
    console.log('GAME OVER');
    this.points = 0;
};

