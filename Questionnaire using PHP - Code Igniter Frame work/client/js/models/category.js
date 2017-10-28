var Category = Backbone.Model.extend({
    initialize: function(options){
        if(options !== undefined){
            this.id = options.id;
        }
    },
    url:function(){
        if(this.id){
            return 'saveCategory?id='+this.id; 
        }else{
            return 'saveCategory';
        }
    },
    urlRoot: 'saveCategory'
});


