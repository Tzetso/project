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
                console.log(score,'score')
                player = data.player;
                console.log(player,'player')
                fn(data);
            });
        },
        getScore:function () {
            return score;
        },
        getPlayerSkin:function() {
        	return player;
        },
        postHighscore: function (scores, coins) {
            console.log(scores, coins)
            $.post('game',{score:scores, coin:coins},function(){
                console.log('Data sent');
            });
        },
        postCoins: function (coins) {
            console.log(coins)
            $.post('game',{coin:coins},function(){
                console.log('Data sent');
            });
        }
    }
}(jQuery);