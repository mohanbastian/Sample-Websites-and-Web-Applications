var EditQuiz = Backbone.View.extend({
    el: '.page',
    render: function(options) {
        if(options.id){
            var that=this;
            var quiz = new Quiz({id: options.id});
            quiz.fetch({
                success: function(quiz){
                    var template = _.template($('#edit-quiz').html(), {quiz:quiz});
                    that.$el.html(template({quiz:quiz}));
                },error: function(response){
                    
                }
            });
        }else{
            var template = _.template($('#edit-quiz').html(), {quiz:null});
            this.$el.html(template({quiz:null}));
        }
    },
    events: {
        'submit .edit-quiz-form': 'saveQuiz'
    },
    saveQuiz: function(ev){
        var quizDetails = $(ev.currentTarget).serializeObject();
        var quiz = new Quiz();
        quiz.save(quizDetails, {
            success: function(quiz){
                var catId= localStorage.getItem('categoryId');
                router.navigate('category/'+catId, {trigger: true});
            },error: function(){
                var catId= localStorage.getItem('categoryId');
                router.navigate('category/'+catId, {trigger: true});
            }
        });
        return false;
    }
});