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
	
	<div class="container justify-content-center text-center text-md-right">
		
	<div class="row justify-content-center">
	
	<div class="col-md-4 col-6 my-2 ">
		<a href="https://taaghche.ir/book/72035" target="_blank">
			<img class="shadow" src="img/ms1.jpg" style="width:100%; height:auto;">
		</a>
	</div>
	<div class="col-md-4 col-6 my-2">
		<a href="https://taaghche.ir/book/71954" target="_blank">
			<img class="shadow" src="img/ms2.jpg" style="width:100%; height:auto;">
		</a>
	</div>
	<div class="col-md-4 col-6 my-2 ">
		<a href="https://taaghche.ir/book/71415" target="_blank">
			<img class="shadow rounded" src="img/ms3.jpg" style="width:100%; height:auto;">
		</a>
	</div>
	<div class="col-md-4 col-6 my-2 ">
		<img class="img pngsh" src="img/gift.png" style="width:100%; height:auto;">
	</div>
	</div>
	</div>
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