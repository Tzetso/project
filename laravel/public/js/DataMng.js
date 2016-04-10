/**
 * Created by User on 10.4.2016 г..
 */
var DataManager = function($){

    var score = 0;

    return{
        getHightScore:function(fn){
            $.get('getscore',function(data){
                score = data;
                fn(data);
            });
        },
        getInternalData:function(){
            return score;
        }
    }
}(jQuery);