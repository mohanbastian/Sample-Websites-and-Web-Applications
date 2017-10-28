<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Simple Quiz</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
        </head>
<body>
<div class="container">
    <?php 
        $this->load->view('header');
    ?>
    <div class="jumbotron">
        <form id="login-form" method="post" action="login" style="margin: 0 auto; padding: 15px; max-width: 330px;">
        <h2 class="form-signin-heading">User Login</h2>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
    
    <script type="text/javascript" src="http://localhost/coursework/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#login-form').submit(function(){
                $.ajax({
                    url:'http://localhost/coursework/userController/login',
                    method: 'post',
                    dataType: 'JSON',
                    data:$(this).serializeObject()
                }).done(function (data) {
                    alert("hello");
                    console.log(data);
                });
            });
        });
   
    </script>
</div>
</body>
</html>