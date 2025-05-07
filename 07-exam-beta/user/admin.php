<!DOCTYPE html>
<html>
<?php
	include("../register/settings.php");
	include("../statics/head.php");  
?>
<head>
	<link href="../input/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="../input/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="../input/js/plugins/piexif.js" type="text/javascript"></script>
    <script src="../input/js/plugins/sortable.js" type="text/javascript"></script>
    <script src="../input/js/fileinput.js" type="text/javascript"></script>
    <script src="../input/js/locales/fr.js" type="text/javascript"></script>
    <script src="../input/js/locales/es.js" type="text/javascript"></script>
    <script src="../input/themes/fas/theme.js" type="text/javascript"></script>
    <script src="../input/themes/explorer-fas/theme.js" type="text/javascript"></script>


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
</head>
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
			<button class="forbid mx-2 btn btn-light " type="button">
			<i class="fa fa-book-open" aria-hidden="true"></i>
				شرکت در آزمون
 			</button>
			<button class="forbid mx-2 btn btn-light " type="button">
			<i class="fa fa-id-card" aria-hidden="true"></i>
				دریافت کارنامه
			</button>
 			<button class="forbid mx-2 btn btn-light " type="button">
			<i class="fas fa-edit"></i>
				ویرایش اطلاعات
  			</button>
 			<button onclick="logout()" id="logout-btn" class=" mx-2 btn btn-light " type="button">
				<i class="fa fa-sign-out-alt"></i>
				خروج
  			</button>
		</div>
	</div>
		<form action='createExam.php' accept-charset="UTF-8" method='POST'> 
		<div class="container">
			<h1>ایجاد آزمون</h1>
				  <hr>
			<div class="row">
				
				<div class="col-md-6 col-12">
				  
				  <label for="name" style="margin:0;"><b>نام آزمون</b></label><br/>
				  <input class="lale form-control mb-2" type="text" placeholder="آزمون جدید" name="name" id="name" required>
				  <div class="row">
					  <div class="col">
						  <label for="test_cnt" style="margin:0;"><b>تعداد تست ها</b></label><br/>
						  <input class="lalee form-control mb-2" type="test_cnt" placeholder="60" name="test_cnt" id="test_cnt" required>
					  </div>
					  <div class="col">
						  <label for="option_cnt" style="margin:0;"><b>تعداد گزینه ها</b></label><br/>
				  <input class="lalee form-control mb-2" type="option_cnt" placeholder="4" name="option_cnt" id="option_cnt" required>
					  </div>
				  </div>
					<div class="row">
					  <div class="col">
						  <label for="start_time" style="margin:0;"><b>شروع بازۀ مجاز</b></label><br/>
				  <input class="lalee form-control mb-2" type="start_time" placeholder="YYYY-MM-DD hh:mm:ss" name="start_time" id="start_time" required>
					  </div>
					  <div class="col">
						  <label for="finish_time" style="margin:0;"><b>پایان بازۀ مجاز</b></label><br/>
				  <input class="lalee form-control mb-2" type="finish_time" placeholder="YYYY-MM-DD hh:mm:ss" name="finish_time" id="finish_time" required>
					  </div>
				  </div>
				  <label for="duration" style="margin:0;"><b> مدت آزمون (به دقیقه)</b></label><br/>
				  <input class="lalee form-control mb-2" type="duration" placeholder="60" name="duration" id="duration" required>
				  
				</div>
				<div class="col-md-6 col-12">
					
				<label for="input-q" style="margin:0;"><b> فایل سوالات آزمون</b></label><br/>
				<input dir="ltr" id="input-q" name="questions" type="file" class="file" accept="application/pdf" data-show-upload="false"  data-show-preview="false"><br>
				<label for="input-q" style="margin:0;"><b> فایل پاسخنامه آزمون </b></label><br/>
				<input dir="ltr" id="input-a" name="answers" type="file" class="file" accept="application/pdf" data-show-upload="false"  data-show-preview="false"><br>
				<label for="input-q" style="margin:0;"><b>فایل کلید آزمون</b></label><br/>
				<input dir="ltr" id="input-k" name="keys" type="file" class="file" accept=".txt" data-show-upload="false"  data-show-preview="false">
					<br>
					
<button type="submit" class="registerbtn lale text-center btn btn-light align-bottom mt-2" style="float:left;">ایجاد آزمون</button>
			</div>
			<hr>
			
		</div>
			
	  </form>
	    <div class="file-loading">
        <input id="" type="file">
    </div>
    <script>
   
    </script>
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