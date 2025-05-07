<!DOCTYPE html>
	<?php
		include("../../register/settings.php");
		include("../../statics/navbar.php");  
		include("../../statics/head.php");  
		//session_start();
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
		<script src="jquery.countdown.js"></script>
		<script src="https://momentjs.com/downloads/moment.js"></script>
	<script src="https://momentjs.com/downloads/moment-timezone-with-data.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
	<?php
		
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
		//var_dump($user_choices);
		//die();
		
		//---------------------------------------------------------------------------------------

	?>
	<body class="bg-info" >

		
		<div class="container justify-content-center">
			<a href="#" type="submit" style="width:100% !important; display:block; position:relative; margin:auto !important;" class=" mx-auto lale text-center btn btn-primary align-bottom m-2 "><h2 class="text-center mt-3">آزمون آزمایشی 1: آرایش الکترون ها</h2><br><h6>برای دانلود سوالات کلیک کنید  <i class="fa fa-download"></i></h6></a>
			<div class="col btn btn-warning mt-2 mb-2 text-white justify-content-center text-center" style="cursor:auto;">
					<i class="fas fa-stopwatch fa-2x"></i> 
					<span id="clock" class=" h3">
					</span>
				</div>
			<div class="row justify-content-center col-12 bg-dark rounded text-white mx-auto pb-4" style="margin-bottom:70px;">
			
			<div class="d-flex justify-content-center fixed-bottom">
				<button type="submit" class="lale text-center btn btn-danger align-bottom m-2">بازگشت <i class="fa fa-arrow-right"></i></button>
			<button class="save lale text-center btn btn-light align-bottom m-2">ذخیرۀ گزینه ها <i class="fa fa-save"></i></button>
			<button class="submit lale text-center btn btn-success align-bottom m-2">ثبت نهایی <i class="fa fa-check"></i></button>
				
		</div>	
			</div>
			
		</div>
		
		<script>
					$(document).ready(function () {
						var brElement = document.createElement("br");
						
						<?php echo "var question_cnt = $questionCnt;"; ?>
						for (var i = 1; i <= question_cnt; i++) {
							var x,f,y;
							x=Math.floor(i/10);
							if (i % 10 != 0){
								x=x+1;	
							}
							if (i % 10 == 1){
								var box = document.createElement("div");
								box.className = x.toString();
								box.innerHTML =`<br>`;
								$(".row").append(box);	
								y="." + x.toString();
								$(y).addClass( "col-lg-3 col-6 p-0" );
							}
							y="." + x.toString();
							
							var element = document.createElement("div");
							element.className = "line";
							element.innerHTML =
								`<span class="mx-3">${i}</span>
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
								</label>`;
							
							
							
							$(y).append(element);
							
						}

								
						$( ".line" ).addClass( "text-center my-1" );
						
					});
				</script>
		
		<script>
			$(document).ready(function () {
				$('label:has(input[type=radio])').on('mousedown', function (e) {
					var radio = $(this).find('input[type=radio]');
					var wasChecked = radio.prop('checked');
					radio[0].turnOff = wasChecked;
					radio.prop('checked', !wasChecked);
				});

				$('label:has(input[type=radio])').on('click', function (e) {
					var radio = $(this).find('input[type=radio]');
					radio.prop('checked', !radio[0].turnOff);
					radio[0]['turning-off'] = !radio[0].turnOff;
				});

				$('.save').on('click', function () {
					if (confirm("آیا از ثبت نهایی اطمینان دارید؟")) {
						var answers = [];
						var lines = $('.line');
						for (var i = 0; i < lines.length; i++) {
							var inputs = $(lines[i]).find('input[type=radio]:checked');
							var lineAnswer = 0;
							if (inputs.length == 1) {
								lineAnswer = +$(inputs[0]).val();
							}
							answers.push(lineAnswer);
						}
						/*var parameters = {
							"array1[]": answers,
						};
						$.post('https://hamedesmaili.com/user/exam/grade_exam.php', parameters);*/
						
						<?php echo "var json = { 'answers': answers, 'exam_id': $exam_id };" ?>
						console.log(json);
						$.ajax({
							type: "POST",
							url: "https://hamedesmaili.com/user/exam/exam_grader.php",
							data: json,
							success: function (result) {
								if(result=="exam saved successfully")
									Swal.fire(
									  'تبریک',
									  'با موفقیت ذخیره شد',
									  'success'
									)
							},
							error: function(xhr, status, error) {
								alert(xhr.responseText);
							}
						});
							   }
						});
					});
                    
                    $('.submit').on('click', function () {
					if (confirm("آیا از ثبت نهایی اطمینان دارید؟")) {
						var answers = [];
						var lines = $('.line');
						for (var i = 0; i < lines.length; i++) {
							var inputs = $(lines[i]).find('input[type=radio]:checked');
							var lineAnswer = 0;
							if (inputs.length == 1) {
								lineAnswer = +$(inputs[0]).val();
							}
							answers.push(lineAnswer);
						}
						/*var parameters = {
							"array1[]": answers,
						};
						$.post('https://hamedesmaili.com/user/exam/grade_exam.php', parameters);*/
						
						<?php echo "var json = { 'answers': answers, 'exam_id': $exam_id, 'end_exam': '1' };" ?>
						$.ajax({
							type: "POST",
							url: "https://hamedesmaili.com/user/exam/exam_grader.php",
							data: json,
							success: function (result) {
								if (result=="exam saved successfully") {
									Swal.fire(
									  'تبریک',
									  'با موفقیت ذخیره شد',
									  'success'
                                    );
                                    window.location.replace("https://hamedesmaili.com/user/exam/result.php");
                                }
							},
							error: function(xhr, status, error) {
								alert(xhr.responseText);
							}
							
						});
					}
					
				});
		
		</script>
		<script>
			
			$(document).ready(function () {
				<?php
					for ($i = 1; $i <= $questionCnt; $i++) {
						$currentCoice = $user_choices[$i - 1];
						if (1 <= $currentCoice && $currentCoice <= 4)
							echo "  $('#o$i-$currentCoice').prop('checked', true);  ";	
					}
				?>
			});
		</script>
		<?php
		//-------------------------------------------------------------------------------------------------
		//Timer
			$exp_date = $finishTime;
			$now = time();
			if ($now < $exp_date) {
		?>
		<script>
		// Count down milliseconds = server_end - server_now = client_end - client_now
			var server_end = <?php echo $exp_date; ?> * 1000;
			var server_now = <?php echo time(); ?> * 1000;
			var client_now = new Date().getTime();
			var end = server_end - server_now + client_now; // this is the real end time

			var _second = 1000;
			var _minute = _second * 60;
			var _hour = _minute * 60;
			var _day = _hour *24
			var timer;

			function doubleDigit(a) {
				var ty
				if (a < 10)
					return '0' + toString(a);
				return a;
			}

			function showRemaining(){
				var now = new Date();
				var distance = end - now;
				if (distance < 0 ) {
				clearInterval( timer );
				document.getElementById('clock').innerHTML = 'EXPIRED!';

				return;
				}
				var days = Math.floor(distance / _day);
				var hours = Math.floor( (distance % _day ) / _hour );
				var minutes = Math.floor( (distance % _hour) / _minute );
				var seconds = Math.floor( (distance % _minute) / _second );

				var countdown = document.getElementById('clock');
				countdown.innerHTML = '';
				if (days) {
					countdown.innerHTML += days + " Days, ";
				}
				hours = doubleDigit(hours);
				minutes = doubleDigit(minutes);
				seconds = doubleDigit(seconds);
				countdown.innerHTML += hours + ":";
				countdown.innerHTML += minutes+ ':';
				countdown.innerHTML += seconds;
			}

			timer = setInterval(showRemaining, 1000);
		</script>
		<?php
			} else {
		?>
		<script>
			var answers = [];
			var lines = $('.line');
			for (var i = 0; i < lines.length; i++) {
				var inputs = $(lines[i]).find('input[type=radio]:checked');
				var lineAnswer = 0;
				if (inputs.length == 1) {
					lineAnswer = +$(inputs[0]).val();
				}
				answers.push(lineAnswer);
			}
							
			<?php echo "var json = { 'answers': answers, 'exam_id': $exam_id, 'end_exam': '1' };" ?>
			$.ajax({
				type: "POST",
				url: "https://hamedesmaili.com/user/exam/exam_grader.php",
				data: json,
				success: function (result) {
					Swal.fire(
						'زمان تمام شد',
						'زمان آزمون شما تموم شد و به صفحه ی کارنامه منتقل میشوید.',
						'info'
					);
					setTimeout(function (){
						window.location.replace("https://hamedesmaili.com/user/exam/result.php");
					}, 4000);
				},
				error: function(xhr, status, error) {
					Swal.fire(
						'خطای غیر منتظره ای رخ داد',
						'لطفا محتویات این خطا را با ادمین های سایت در میان بگذارید' + xhr.responseText,
						'error'
					);
					setTimeout(function (){
						window.location.replace("https://hamedesmaili.com/user/exam/result.php");
					}, 6000);
				}
								
			});
		</script>
	
		<?php
			}
			//-------------------------------------------------------------------------------------------------
		?>
		<div id="countdown"></div>

	</body>

	</html>