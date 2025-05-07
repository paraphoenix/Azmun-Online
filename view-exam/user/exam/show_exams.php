<!DOCTYPE html>
<?php
	include("../../register/settings.php");
	include("../../statics/head.php");  
?>
<html>

<head>
	<title>شیمی پلاس</title>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>
</style>

<body class="bg-info" >
<?php
	include "../../statics/navbar.php";
?>
	<div class="container">
		<h2 class="text-center mt-3">لیست آزمون های فعال</h2>
		<div class="row">
			<ul> 
                <?php 
                    $sql = "SELECT * FROM exam WHERE is_active = '1'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($exam =  $result->fetch_array()) {
                            //var_dump($exam);
                            $exam_id = $exam[0];
                            $exam_name = $exam[1];
                            $test_cnt = $exam[2];
                            $option_cnt = $exam[3];
                            $exam_duration = $exam[4];
                            $start_time = $exam[5];
                            $finish_time = $exam[6];
                            echo "<li>" . $exam_name . "<a href='https://hamedesmaili.com/user/exam/register_exam.php?e_id=$exam_id'> شرکت در آزمون </a>" . "</li>";  
                        }
                    } else {
                        echo "در حال حاضر آزمون فعالی وجود ندارد.";
                    }

                ?>
            </ul>
		</div>
	</div>
</body>

</html>