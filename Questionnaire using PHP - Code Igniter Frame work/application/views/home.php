<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Simple Quiz</title>
        <link href="js/bootstrap.min.css" rel="stylesheet" type="text/css"/>
         </head>
<body>
<div class="container">
    <?php 
        $this->load->view('header');
    ?>
    <div class="jumbotron">
      <h1>PHP Quizzes</h1>
      <p>This a web site developed for learning php by doing mcqs in different sections.</p>

        <div class="form-group">
        <form name="categoryform" id="categoryform" method="GET" action="index.php/quizController/runQuiz" >
            <label>Select the category</label>
            <select class="form-control" id="categories" name="categories">
                <?php
                if(isset($category)){
                    foreach ($category as $cat){
                        ?><option value= "<?php echo $cat->ID ?>" > <?php echo $cat->Name?> </option> <?php
                    }
                }
                ?>
            </select><br>
            <input class="btn btn-primary btn-sm" type="submit" value="Start Quiz">
        </form>
        </div>
    </div>
    
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
</div>
</body>
</html>