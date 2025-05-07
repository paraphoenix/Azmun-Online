<!DOCTYPE html>
	<?php
		include("../../register/settings.php");
		include("../../statics/navbar.php");  
		include("../../statics/head.php");  
		//session_start();
	?>
<html>

<head>
	<title>کارنامه</title>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	  <script src="jquery.countdown.js"></script>
	  <script src="https://kit.fontawesome.com/68301943d0.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>

@import url('https://fonts.googleapis.com/css2?family=Lalezar&display=swap');

body {
  font-family: 'Lalezar', cursive !important;
  }
.forbid{
	cursor:not-allowed !important;
	}
.lale{
	font-family: 'Lalezar', cursive !important;
}
	.submit{
	cursor:pointer;
}
.rtl{
	direction:rtl;
	text-align:right;
}
.ltr{
	
	text-align:left;
}
img{
	cursor:pointer;
	}
	.pngsh{
  -webkit-filter: drop-shadow(5px 5px 5px #222);
  filter: drop-shadow(5px 5px 5px #222);
}
@media screen and (max-width: 980px) {
 .ltr{
	text-align:center;
}

	}
}
</style>

<body class="bg-info" >

	<div class="container">
		
		
	<a href="../../files/exams/azmun-2/answers.pdf" target="_blank" type="submit" style="width:100% !important; display:block; position:relative; margin:auto !important;" class=" mx-auto lale text-center btn btn-primary align-bottom m-2 "><h2 class="text-center mt-3">آزمون آزمایشی 1: آرایش الکترون ها</h2><br><h6>برای دانلود پاسخنامه آزمون کلیک کنید  <i class="fa fa-download"></i></h6></a>
	
    <?php
		//$t = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
		$tru = array(0,2,1,1,4,3,2,2,3,3,3 ,1 ,1 ,3 ,2 ,3 );
		// Connect to DB
		//---------------------------------------------------------------------------------------
		$conn = connectToDB();
		//---------------------------------------------------------------------------------------

		// Select user data from DB
		//---------------------------------------------------------------------------------------\
		$user_email = $_SESSION['email'];
		$sql = "SELECT * FROM user WHERE email = '$user_email'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_row();
			$u_id = $row[0] + 0;
		} else {
			echo "Error 004";
			unset($_SESSION['email']);
			die();
			// Error 004 yani emaili ke tuye session mojud hast namotabar hast ya user ba in email dar db pak shode
		}

		$sql = "SELECT * FROM user_exam WHERE u_id = '$u_id'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_row();
			$exam_id = $row[2] + 0;
		} else {
			echo "shoma dar azmuni sherkat nakardid";
			die();
		}
		//---------------------------------------------------------------------------------------
		
		// Select exam from database
		//---------------------------------------------------------------------------------------
		$sql = "SELECT * FROM user_exam WHERE u_id = $u_id";
		$result = $conn->query($sql);

		if ($result->num_rows == 0) {
			echo "You have not registered in any exams";
			die();
		}

		$row = $result->fetch_row();
		$userexam_id = $row[0] + 1;
		$exam_id = $row[2] + 0;
		$finishTime = $row[4] + 0;
		$finishTimeFormatted = timeStamp2Format($finishTime);

		$sql = "SELECT * FROM exam WHERE id = $exam_id";
		$result = $conn->query($sql);

		if ($result->num_rows == 0) {
			echo "Error 005";
			die();
			//Error 005 yani ye satr dar exam pak shode vali dar user_exam hast
		}
		$row = $result->fetch_row();
		$questionCnt = $row[2] + 0;
		//---------------------------------------------------------------------------------------

		// Check if result already exists in DB
		//---------------------------------------------------------------------------------------
		$sql = "SELECT * FROM userexam_result WHERE userexam_id = $userexam_id";
		$result = $conn->query($sql);

		if ($result->num_rows == 0) {
			// Calculate rank
			$isRankingSaved = false;	
		} else {
			// Read rank from DB
			$isRankingSaved = true;
			$row = $result->fetch_row();
			$result_id = $row[2] + 0;
			
			$sql = "SELECT * FROM result WHERE id = $result_id";
		
			$result = $conn->query($sql);
			
			
			if ($result->num_rows > 0) {
				$ranking = array();
				while ($row =  $result->fetch_array()) {
					//var_dump($result);
					$grade = $row[1] + 0;
					$ranking[$grade] = array();
					$ranking[$grade]["score"] = $row[2] + 0;
					$ranking[$grade]["correct_cnt"] = $row[3] + 0;
					$ranking[$grade]["false_cnt"] = $row[4] + 0;
					$ranking[$grade]["empty_cnt"] = $row[5] + 0;
					$score = $ranking[$grade]["score"];
					$sql = "SELECT score FROM result WHERE grade = $grade AND exam_id = $exam_id AND score > $score";
					$result = $conn->query($sql);
					var_dump($result);
					$ranking[$grade]["rank"] = $result->num_rows + 1;
					echo "aaa " . $grade . " " . $ranking[$grade]["rank"];
				}
			} else {
				echo "Error 008";
				die();
				//errore 008 yani dar db ye satr dar userexam_result vojud dare ke id e motanazeresh dar jadvale result nist
			}
		}
		//---------------------------------------------------------------------------------------

		// Read user choices from DB 
		//---------------------------------------------------------------------------------------
		$user_choices = array();
		for ($i = 0; $i < $questionCnt; $i++) {
			array_push($user_choices, 0);
		}

		$sql = "SELECT * FROM user_question WHERE u_id = $u_id AND exam_id = $exam_id";
		
		$result = $conn->query($sql);
		
		
		if ($result->num_rows > 0) {
			while ($row =  $result->fetch_array()) {
				//var_dump($result);
				$q_number = $row[3] + 0;
				$user_choice = $row[4] + 0;
				$user_choices[$q_number - 1] = $user_choice;
			}
		} else {
			//inja yani hanuz gozine i dar db zakhire nashode
			//die();
		}
		//---------------------------------------------------------------------------------------
		

	?>

	<script>
		//c->correct w->wrong e->empty
		var c=0,w=0,e=0;
		var count="<?php echo $questionCnt ?>"; ;
		var ans = new Array();	
		var tru = new Array(0,1,2,1,2,1,2,1,2,1,2,1,2,1,2,1,2,1,2);	
		for (var i = 1; i <= count; i++) {
			if(ans[i]==tru[i]){
				c++;	
				
			}
			else if(ans[i]==0){
				e++;	
			}
			else{
				w++;	
			}
		}
		 
	</script>
		
	<table class="table table-striped table-light table-bordered table-hover" style="direction:rtl; text-align:right;">
    <thead>
	
      <tr>
        <th>پایه</th>
        <th>درصد</th>
        <th>درست</th>
		<th>نادرست</th>
		<th>نزده</th>
		<th>رتبه</th>
      </tr>
    </thead>
    <tbody>
	
      <tr>
        <td>دهم</td>
        <td>__</td>
        <td>__</td>
		<td>__</td>
		<td>__</td>
		<td>__</td>
      </tr>
      <tr>
        <td>یازدهم</td>
        <td>__</td>
        <td>__</td>
		<td>__</td>
		<td>__</td>
		<td>__</td>
      </tr>
      <tr>
        <td>دوازدهم</td>
        <td>__</td>
        <td>__</td>
		<td>__</td>
		<td>__</td>
		<td>__</td>
      </tr>
	  <tr>
        <td>برایند</td>
		<!--percent correct wrong empty-->
        <td><?php echo $ranking[13]["score"]?></td>
        <td><?php echo $ranking[13]["correct_cnt"]?></td>
        <td><?php echo $ranking[13]["false_cnt"]?></td>
        <td><?php echo $ranking[13]["empty_cnt"]?></td>
		<td><?php echo $ranking[13]["rank"]?></td>
      </tr>
    </tbody>
  </table>
		<script>
			var per=((c*3-w)/(count*3)*100).toFixed(1);
			document.getElementById("cor").innerHTML = c.toString();
			document.getElementById("wro").innerHTML = w.toString();
			document.getElementById("emp").innerHTML = e.toString();
			document.getElementById("per").innerHTML = per.toString();
		</script>

		<button data-toggle="collapse" data-target="#test" class="btn btn-warning container-fluid">
			پاسخبرگ شما   <i class="fa fa-chevron-down"></i>
		</button>
		<div id="test" class=" row justify-content-center col-12 bg-dark rounded text-white mx-auto p-0 pb-4" style="margin-bottom:70px;">
		<div id="test" class="r row justify-content-center col-12 mx-auto p-0">
			<script>
				$(document).ready(function () {
					var brElement = document.createElement("br");
				
					for (var i = 1; i <= count; i++) {
						var x,f,y,g;
						g=2;
						x=Math.floor(i/10);
						if (i % 10 != 0){
							x=x+1;	
						}
						if (i % 10 == 1){
							var box = document.createElement("div");
							box.className = x.toString();
							box.innerHTML =`<br>`;
							$(".r").append(box);	
							y="." + x.toString();
							$(y).addClass( "col-lg-3 col-6 p-0" );
						}
						y="." + x.toString();
						
						var element = document.createElement("div");
						element.className = "line";
						element.innerHTML =
							`
							<span class="mx-3">${i}</span>
							<label class="test">
								<input id="o${i}-1" type="radio" value="1" name="q[${i}]">
									<span id="s${i}-1" class="checkmark"></span>
							</label>
							<label class="test">
							<input id="o${i}-2" type="radio" value="2" name="q[${i}]">
							<span id="s${i}-2" class="checkmark"></span>
							</label>
							<label class="test">
							<input id="o${i}-3" type="radio" value="3" name="q[${i}]">
							<span id="s${i}-3" class="checkmark"></span>
							</label>
							<label class="test">
							<input id="o${i}-4" type="radio" value="4" name="q[${i}]">
							<span id="s${i}-4" class="checkmark"></span>
							</label>		
							`;
						$(y).append(element);
						/*
						if(ans[i]==tru[i]){
							$("#o"+i+"-"+ans[i]).prop('checked', true);
							$("#s"+i+"-"+ans[i]).addClass("bg-success");
						}
						else if(ans[i]!=0){
							$("#o"+i+"-"+ans[i]).prop('checked', true);	
							$("#o"+i+"-"+tru[i]).prop('checked', true);	
							$("#s"+i+"-"+tru[i]).addClass("bg-info");
							$("#s"+i+"-"+ans[i]).addClass("bg-danger");
						}
						else {
							$("#o"+i+"-"+tru[i]).prop('checked', true);	
							$("#s"+i+"-"+tru[i]).addClass("bg-warning");
						}
						*/
					}

							
					$( ".line" ).addClass( "text-center my-1" );
					
				});
			</script>
			<script>
			
$( document ).ready(function() {
	
	$("input"). attr('disabled', true);
});
						
			</script>
				
		</div>
			
		
			<br class="m-2"/>
			<div class="bg-success rounded" style="width:30px; height:20px;"></div><h6 class="m-1">گزینۀ صحیح شما</h6>
			<br class="m-2"/>
			<div class="bg-danger rounded " style="width:30px; height:20px;"></div>
			<div class="bg-info rounded" style="width:30px; height:20px;"></div><h6 class="m-1">گزینۀ غلط شما</h6>
			<br class="m-2"/>
			<div class="bg-warning rounded" style="width:30px; height:20px;"></div><h6 class="m-1">گزینۀ نزدۀ شما</h6>
		</div>
		<div class="d-flex justify-content-center fixed-bottom">
			<a href="../user.php" class="lale text-center btn btn-danger align-bottom m-2">بازگشت <i class="fa fa-arrow-right"></i></a>
		
			
	</div>
	</div>
	
    
</body>
<script>	
$(document).ready(function () {
		//hey
		<?php
		$c = 0; $w =0; $e = 0;
		//$t = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
		$tru = array(0,2,1,1,4,3,2,2,3,3,3 ,1 ,1 ,3 ,2 ,3 );
		for ($i = 1; $i <= $questionCnt; $i++) {
			$currentCoice = $user_choices[$i - 1];
			echo "  $('#o$i-$currentCoice').prop('checked', true);  ";	
			if($currentCoice==$tru[$i]){
			echo "  $('#o$i-$currentCoice').prop('checked', true); ";
			echo "  $('#s$i-$currentCoice').addClass('bg-success'); ";
			$c++;
			}
			else if($currentCoice!=0){
			echo "  $('#o$i-$currentCoice').prop('checked', true);	";
			echo "  $('#o$i-$tru[$i]').prop('checked', true);	";
			echo "  $('#s$i-$tru[$i]').addClass('bg-info'); ";
			echo "  $('#s$i-$currentCoice').addClass('bg-danger'); ";
			$w++;
			}
			else {
			echo "  $('#o$i-$tru[$i]').prop('checked', true);	";
			echo "  $('#s$i-$tru[$i]').addClass('bg-warning'); ";
			$e++;
			}
		}
		
		$per=  sprintf('%0.1f',(($c*3-$w)/($questionCnt*3)*100));
		?>
		document.getElementById ("cor"). innerHTML = "<?php echo $c?>";
		document.getElementById ("wro"). innerHTML = "<?php echo $w?>";
		document.getElementById ("emp"). innerHTML = "<?php echo $e?>";
		document.getElementById ("per"). innerHTML = "<?php echo $per?>";
	});
</script>

	<?php
		if ($isRankingSaved == false) {
			for ($grade = 12; $grade <= 13; $grade++) {
				$sql =  "INSERT INTO result (grade, score, correct_cnt, false_cnt, empty_cnt, exam_id) VALUES ($grade, $per, $c, $w, $e, $exam_id)";
				$result = $conn->query($sql);
				$result_id = mysqli_insert_id($conn);
				
				echo $result_id;

				if ($result === FALSE) {
					$error = "Error: " . $sql . "<br>" . $conn->error;
					echo "alert($error)";
					//echo "warum";
				}	 else {
					echo "as ecpected";
				}
			}
			
			$sql =  "INSERT INTO userexam_result (userexam_id, result_id) VALUES ($userexam_id, $result_id)";
			$result = $conn->query($sql);

			if ($result === FALSE) {
				$error = "Error: " . $sql . "<br>" . $conn->error;
				echo $error;
				die();
			}  

		}
	?>
		
		
</html>