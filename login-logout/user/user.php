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
@media screen and (max-width: 768px) {
 .ltr{
	
	text-align:center;
}
}
</style>

<body class="bg-info rtl" >
	<?php
		include "../statics/navbar.php";
	?>
	<div class="container justify-content-center text-center text-md-right">
	<div class="row">
	<div class="col-md-6">
	<h2>نام</h2>
	</div>
	<div class="col-md-6 ltr">
	<button class="" type="button">
		<i class="fa fa-book-open" aria-hidden="true"></i>
		شرکت در آزمون
  </button>
	<button class="" type="button">
		<i class="fa fa-id-card" aria-hidden="true"></i>
		دریافت کارنامه
  </button>
  <button class="" type="button">
		<i class="fas fa-edit"></i>
		ویرایش اطلاعات
  </button>
  <button onclick="logout()" id="logout-btn" class="" type="button">
		<i class="fa fa-sign-out-alt"></i>
		خروج
  </button>
  </div>
	</div>
	</div>
</body>

<script>
	function logout() {
		window.location.replace("https://hamedesmaili.com/user/logout.php");
	}
</script>

</html>