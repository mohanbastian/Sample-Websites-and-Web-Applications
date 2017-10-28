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
      <h1>User Profile</h1>
        <?php 
            echo $userData;
        ?>
    </div>
    
    <script type="text/javascript" src="http://localhost/coursework/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url:'http://localhost/coursework/index.php/userController/getUser',
                    method: 'get',
                    dataType: 'JSON'
                }).done(function (data) {
                    alert("hello");
                    $('#testid').html(data.arr);
                    alert("hello");
                    console.log(data.arr);
                });
                
            $.ajax({
                 type:'POST'    
                })
        });
   
    </script>
</div>
</body>
</html>