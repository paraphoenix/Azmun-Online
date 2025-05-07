<!DOCTYPE html>
<html>
<?php
	include("../register/settings.php");
	include("../statics/head.php");  
?>
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

<body class="bg-info rtl" >
	<?php
		include "../statics/navbar.php";
		if ($is_admin != '1') {
			echo "You don't have premission to see this page.";
			die();
		}
	?>
	<div class="container-fluid ">
		<div class="row justify-content-center mb-3 ">
			<button class="forbid mx-2" type="button">
			<i class="fa fa-book-open" aria-hidden="true"></i>
				شرکت در آزمون
 			</button>
			<button class="forbid mx-2" type="button">
			<i class="fa fa-id-card" aria-hidden="true"></i>
				دریافت کارنامه
			</button>
 			<button class="forbid mx-2" type="button">
			<i class="fas fa-edit"></i>
				ویرایش اطلاعات
  			</button>
 			<button onclick="logout()" id="logout-btn" class=" mx-2" type="button">
				<i class="fa fa-sign-out-alt"></i>
				خروج
  			</button>
		</div>
	</div>
		<form action='createExam.php' accept-charset="UTF-8" method='POST'> 
		<div class="container">
		  <h1>ایجاد آزمون</h1>
		  
		  <hr>
		  
		  <label for="name"><b>اسم آزمون</b></label>
		  <input class="lale" type="text" placeholder="آزمون جدید" name="name" id="name" required>
		  <br>

		  <label for="test_cnt"><b>تعداد تست ها</b></label>
		  <input class="lale" type="test_cnt" placeholder="60" name="test_cnt" id="test_cnt" required>
		  <br>

		  <label for="option_cnt"><b>تعداد گزینه ها</b></label>
		  <input class="lale" type="option_cnt" placeholder="4" name="option_cnt" id="option_cnt" required>
	      <br>

		  <label for="duration"><b> مدت آزمون (به دقیقه)</b></label>
		  <input class="lale" type="duration" placeholder="60" name="duration" id="duration" required>
		  <br>

		  <label for="start_time"><b>زمان شروع  </b></label>
		  <input class="lale" type="start_time" placeholder="YYYY-MM-DD hh:mm:ss" name="start_time" id="start_time" required>
		  <br>
		  
		  <label for="finish_time"><b>زمان پایان  </b></label>
		  <input class="lale" type="finish_time" placeholder="YYYY-MM-DD hh:mm:ss" name="finish_time" id="finish_time" required>
		  <br>
		  <hr>
	  
	  
		  <button type="submit" class="registerbtn lale">ایجاد آزمون</button>
		</div>
	  </form>
</body>
<?php
	session_start();
      if($_SESSION['alert'] == 4){
			echo "<script>swal('تبریک!', 'با موفقیت وارد شدی', 'success'); </script>";
		}
		unset ($_SESSION['alert']);
  ?>
<script>
	$(".img").click(function(){
		swal('صبر داشته باش!', 'به زودی امکان دانلود برات فراهم میشه', 'info');
	});
	function logout() {
		window.location.replace("logout.php");
	}
</script>

</html>