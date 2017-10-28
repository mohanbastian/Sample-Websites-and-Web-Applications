var Quizs = Backbone.Collection.extend({
    //model: app.Quiz,
    url: 'getQuiz'
});
var CatQuiz = Backbone.Collection.extend({
    initialize: function(options){
        this.id = options.id;
    },
    url:function(){
        return 'getQuizForCategory?id='+this.id
    }
});
