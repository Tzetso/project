var GameState = function(game,game_master) {

    this.game = game;
    this.currentPlatformsCount = 0;
    this.platformArray = [];

};
GameState.prototype.preload = function () {

    this.game.stage.backgroundColor = '#85b5e1';

    this.game.load.baseURL = 'http://examples.phaser.io/assets/';
    this.game.load.crossOrigin = 'anonymous';

    this.game.load.image('player', 'sprites/phaser-dude.png');
    this.game.load.image('platform', 'sprites/platform.png');


};
GameState.prototype.create = function () {

    this.game.world.resize(600, 15000);

    this.player = this.game.add.sprite(200, 14800, 'player');

    this.game.physics.arcade.enable(this.player);

    this.player.body.collideWorldBounds = false;
    this.player.body.gravity.y = 600;
    this.player.body.drag.setTo(200);
    this.player.body.drag.x = 300;
    this.land = this.game.add.sprite(0,14950,'platform');
    this.game.physics.arcade.enable(this.land);
    this.land.body.immovable = true;

    this.land.body.allowGravity = false;
    this.createPlatforms();

    this.cursors = this.game.input.keyboard.addKeys( { 'up': Phaser.KeyCode.W, 'down': Phaser.KeyCode.S, 'left': Phaser.KeyCode.A, 'right': Phaser.KeyCode.D } );
    this.jumpButton = this.game.input.keyboard.addKey(Phaser.Keyboard.SPACEBAR);
    this.game.camera.follow(this.player);

    for(var i = 0;i < 150; i++){
        this.platformArray[i] = this.platforms.getFirstExists(false);
        var x = this.game.rnd.realInRange(1, 300);
        this.platformArray[i].reset(x,(this.player.y - i*150));
        this.platformArray[i].scale.x = this.game.rnd.realInRange(0.3, 0.6);
    }

    this.killPlatforms();
};
GameState.prototype.update = function () {



    this.game.physics.arcade.collide(this.player, this.platforms);
    this.game.physics.arcade.collide(this.player, this.land);

    //this.player.body.velocity.x = 0;

    if (this.cursors.left.isDown)
    {
        this.player.body.velocity.x = -250;
    }
    else if (this.cursors.right.isDown)
    {
        this.player.body.velocity.x = 250;
    }

    if (this.jumpButton.isDown && (this.player.body.onFloor() || this.player.body.touching.down))
    {
        this.player.body.velocity.y = -500;
    }

};
GameState.prototype.render = function(){
    this.game.debug.cameraInfo(this.game.camera, 32, 32);
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
        if(p.y - this.player.y){
            p.kill();
        }
    }


};
GameState.prototype.killPlatforms = function(){
    console.log(this.platforms.children[0]);
    var t = 3000;
    var i = null;
    var _this = this;
    function callTimeout(){

        i = setTimeout(function(){
            callTimeout();
            var platformToKill = _this.platforms.getFirstExists().kill();
            if (_this.player.position.y > _this.platforms.getFirstExists().position.y) {
                _this.killPlayer();
                clearTimeout(i)
            }
            t -= 10;
            console.log(t);
            if (t <= 0){
                clearTimeout(i)
            }
        }, t)
    }


    callTimeout();

};

GameState.prototype.killPlayer = function() {
    this.game.state.start('end-game-state');
};

