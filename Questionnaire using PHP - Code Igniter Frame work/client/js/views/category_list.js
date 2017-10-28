var CategoryList = Backbone.View.extend({
    el: '.page',
    render: function() {
        var that = this;
        var categories = new Categories();
        categories.fetch({
            ajaxSync: true,
            success: function(categories){
                localStorage.setItem('categoryList', JSON.stringify(categories));
                var template = _.template($('#category-list').html(),{categories:categories.models});
                that.$el.html(template({categories:categories.models}));           
            },error: function(error){
                console.log(error);
            }
        });
    }
});