var EditCategory = Backbone.View.extend({
    el: '.page',
    render: function(options) {
        
        if(options.id){
            var that=this;
            var category = new Category({id:options.id});
            category.fetch({
                success: function(category){
                    var template = _.template($('#edit-category').html(), {category:category});
                    that.$el.html(template({category:category}));
                },error: function(response){
                    
                }
            });
        }else{
            var template = _.template($('#edit-category').html(), {category:null});
            this.$el.html(template({category:null}));
        }
    },
    events: {
        'submit .edit-category-form': 'saveCategory'
    },
    saveCategory: function(ev){
        var categoryDetails = $(ev.currentTarget).serializeObject();
        var category = new Category();
        category.save(categoryDetails, {
            success: function(category){
                router.navigate('', {trigger: true});
            },error: function(){
                router.navigate('', {trigger: true});
            }
        });
        return false;
    }
});

