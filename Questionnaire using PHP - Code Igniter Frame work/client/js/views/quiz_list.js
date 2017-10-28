var QuizList = Backbone.View.extend({
    el: '.page',
    render: function(options) {
        var that = this;
        var quizs = new CatQuiz({id: options.id});
        this.setSelectedCategory(options.id);
        quizs.fetch({
            success: function(quizs){
                var template = _.template($('#quiz-list').html(),{quizs:quizs.models});
                that.$el.html(template({quizs:quizs.models}));           
            }
        });
    },
    setSelectedCategory: function(id){
        localStorage.setItem('categoryId', id);
        var categories = JSON.parse(localStorage.getItem('categoryList'));
        var selected = categories[id-1];
        localStorage.setItem('categoryName', selected['Name']);
    }
});
