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
    <form name="quizform" id="quizform" method="GET" action="runQuiz" >

    <?php
    if(isset($quiz)){

        echo $quiz->name;?> <br>
        <div class="radio">
            <input type="radio" name="choice" value="<?php echo $quiz->choice1;?>"><?php echo $quiz->choice1; ?><br>
        </div>
        <div class="radio">
        <input type="radio" name="choice" value="<?php echo $quiz->choice2;?>"><?php echo $quiz->choice2; ?><br>
        </div>
        <?php
        if(isset($quiz->choice3) && $quiz->choice3 !== ''){
        ?>
            <div class="radio">
            <input type="radio" name="choice" value="<?php echo $quiz->choice3;?>"><?php echo $quiz->choice3; ?><br>
            </div>
            <?php
            if(isset($quiz->choice4) && $quiz->choice4 !== ''){ ?>
                <div class="radio">
                <input type="radio" name="choice" value="<?php echo $quiz->choice4;?>"><?php echo $quiz->choice4; ?><br>
                </div>
                <?php
            }
        }
    }
    ?>
        <input type="submit" value="NextQuiz">
    </form>
</div>

</body>
</html>