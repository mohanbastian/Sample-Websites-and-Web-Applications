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
    <p class="text-primary">Your Final Score: 
    <?php 
        echo $percentage;
    ?></p>
    <p>You have answered <?php echo $answered;?> out of <?php echo $total;?> in <?php echo $time;?></p>
    <p class="text-success">Correct answers: 
    <?php 
        echo $correct;
    ?></p>
    <p class="text-danger">Wrong answers: 
    <?php 
        echo $wrong;
    ?></p>
    <br><a class="btn btn-default btn-lg" href="../" role="button">GO to home</a></p>
</div>
</body>
</html>
