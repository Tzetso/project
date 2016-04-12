/**
 * Created by User on 10.4.2016 г..
 */
var DataManager = function($){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    var score = 0;

    return{
        getHightScore:function (fn) {
            $.get('getdata',function(data){
                score = data.highscore;
                console.log(score,'score');
                player = data.player;
                console.log(player,'player');
                shields = data.shields;
                console.log(shields,'shields');
                revives = data.revives;
                console.log(revives,'revives');
                fn(data);
            });
        },
        getScore:function () {
            return score;
        },
        getPlayerSkin:function() {
        	return player;
        },
        getShields:function() {
        	return shields;
        },
        getRevives:function() {
        	return revives;
        },
        postHighscore: function (scores, coins, shields, revives) {
            console.log(scores, coins, shields, revives)
            $.post('game',{score:scores, coin:coins, shield:shields, revive:revives},function(){
                console.log('Data sent');
            });
        },
        postCoins: function (coins, shields, revives) {
            console.log(coins, shields, revives)
            $.post('game',{coin:coins},function(){
                console.log('Data sent');
            });
        }
    }
}(jQuery);