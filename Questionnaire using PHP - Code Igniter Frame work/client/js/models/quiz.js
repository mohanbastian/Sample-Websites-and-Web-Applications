var Quiz = Backbone.Model.extend({
    
    initialize: function(options){
        if(options !== undefined){
            this.id = options.id;
        }
    },
    url:function(){
        if(this.id){
            return 'saveQuiz?id='+this.id; 
        }else{
            return 'saveQuiz';
        }
    },
    urlRoot: 'saveQuiz'
});