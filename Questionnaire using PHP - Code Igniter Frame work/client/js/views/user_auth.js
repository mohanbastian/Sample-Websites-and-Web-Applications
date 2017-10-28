var UserAuth = Backbone.View.extend({
    el: '.page',
    render: function() {
        var that = this;
        if(localStorage.getItem('accessToken')){
            bootbox.confirm("Do you want to Sign out?", function(result) {
                if(result){
                    localStorage.removeItem('accessToken');
                    localStorage.removeItem('loggedUser');
                    //router.navigate('/login', {trigger:true});
                    that.render();
                }else{
                    window.history.back();
                }
            }); 
        }else{
            var template = _.template($('#user-login').html(),{});
            this.$el.html(template);
        }
    },
    events: {
        'submit #user-login-form': 'authenticateUser'
    },
    authenticateUser: function(ev){
        var userDetails = $(ev.currentTarget).serializeObject();
        var user = new User();
        var that = this;
        user.save(userDetails, {
            success: function(user){
                if(user.get('token')== undefined){
                    bootbox.alert(user.get('msg'));
                    that.render();
                }else{
                    localStorage.setItem('loggedUser', JSON.stringify(user));
                    localStorage.setItem('accessToken', user.get('token'));
                    router.navigate('', {trigger: true});
                }
            },error: function(){
               // localStorage.setUser('loggedUser', user);
                //router.navigate('', {trigger: true});
            }
        });
        return false;
    }
});