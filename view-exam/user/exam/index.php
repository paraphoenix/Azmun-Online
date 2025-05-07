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
		<h2 class="text-center mt-3">آزمون اول شیمی پلاس</h2>
		<div class="row">
			
		</div>
	</div>
	<div class="submit bg-dark text-center col-md-2 mx-auto text-white p-1" style="border-radius: 50px 50px 0px 0px;">ثبت نهایی</div>
	<script>
				$(document).ready(function () {
					var brElement = document.createElement("br");
					
					for (var i = 1; i <= 120; i++) {
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
								<input type="radio" value="1" name="q[${i}]">
									<span class="checkmark"></span>
							</label>
							<label class="test">
							<input type="radio" value="2" name="q[${i}]">
							<span class="checkmark"></span>
							</label>
							<label class="test">
							<input type="radio" value="3" name="q[${i}]">
							<span class="checkmark"></span>
							</label>
							<label class="test">
							<input type="radio" value="4" name="q[${i}]">
							<span class="checkmark"></span>
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
					
					var json = { 'answers': answers };
					console.log(json);
					$.ajax({
						type: "POST",
						url: "https://hamedesmaili.com/user/exam/exam_grader.php",
						data: json,
						success: function (result) {
                            alert(result);
						},
						error: function(xhr, status, error) {
							alert(xhr.responseText);
						}
                        
					});
				}
			});
		});
	</script>

</body>

</html>