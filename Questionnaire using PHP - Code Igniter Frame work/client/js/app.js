 $.ajaxPrefilter(function (options, originalOptions,jqXHR){
     options.url = 'http://localhost/coursework/index.php/admin/' + options.url;
 });
 
 $.fn.serializeObject = function() {
      var o = {};
      var a = this.serializeArray();
      $.each(a, function() {
          if (o[this.name] !== undefined) {
              if (!o[this.name].push) {
                  o[this.name] = [o[this.name]];
              }
              o[this.name].push(this.value || '');
          } else {
              o[this.name] = this.value || '';
          }
      });
      return o;
  };
  
function _request(url, method, data, callback) {
  $.ajax({
    url: url,
    contentType: "application/json",
    dataType: "json",
    type: method,
    data:  JSON.stringify( data ),
    success: function (response) {
      if ( !response.error ) {
        if ( callback && _.isFunction(callback.success) ) {
          callback.success(response);
        }
      } else {
        if ( callback && _.isFunction(callback.error) ) {
          callback.error(response);
        }
      }
    },
    error: function(mod, response){
      if ( callback && _.isFunction(callback.error) ) {
        callback.error(response);
      }
    }
  });
}
 
 function checkUser(){
     if(localStorage.getItem('accessToken')==undefined){
         router.navigate('/login', {trigger:true});
     }else{
         return true;
     }
 }
 
 var Router = Backbone.Router.extend({
    routes: {
        '': 'home',
        'newcategory': 'editCategory',
        'editcategory/:id': 'editCategory',
        'category/:id': 'categoryQuiz',
        'newquiz':'editQuiz',
        'editquiz/:id': 'editQuiz',
        'login': 'login',
        '*path':'home'
    }
});
var categoryList = new CategoryList();
var editCategory = new EditCategory();
var quizList = new QuizList();
var editQuiz = new EditQuiz();
var login = new UserAuth();

var router = new Router();
router.on('route:home', function() {
    if(checkUser()){
        categoryList.render();
    }
});

router.on('route:categoryQuiz', function(id){
   if(checkUser()){
        quizList.render({id: id}); 
    }
});

router.on('route:editCategory', function(id){
    if(checkUser()){
        editCategory.render({id:id});
    }
});

router.on('route:editQuiz', function(id){
    if(checkUser()){
        editQuiz.render({id:id});
    }
});

router.on('route:login', function(){
    login.render();
});


Backbone.history.start();