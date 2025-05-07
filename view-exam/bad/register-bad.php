<?php 
  // Includes
  include("settings.php");  
  
  // Redirect to a page
  doRedirects();
?>

<!DOCTYPE html>
<html>
<body>

<?php echo "<form action='$registerUserPage' method='POST'>" ?>
  <div class="container">
    <h1>ثبت نام</h1>
    <p>لطفا برای تکمیل ثبت نام فرم زیر را پر کنید.</p>
    <hr>
	
    <label for="name"><b>نام</b></label>
    <input type="text" placeholder="Name" name="name" id="name" required>
    
    <label for="email"><b>ایمیل</b></label>
    <input type="text" placeholder="Email" name="email" id="email" required>
    

    <label for="phone"><b>شماره تلفن همراه</b></label>
    <input type="text" placeholder="Phone" name="phone" id="phone" required>      
  

    <label for="password"><b>رمز</b></label>
    <input type="password" placeholder="Password" name="password" id="password" required>

    <hr>


    <button type="submit" class="registerbtn">ثبت نام</button>
  </div>
  <div class="container signin">
    <?php
        echo "<p>شماره تو تایید نکردی؟<a href='$phonePage'> شماره تو تایید کن</a></p>";
        //echo "<p>قبلا شماره تو تایید کردی‌؟ <a href='$registerPage'>ثبت نام کن</a></p>";
        echo "<p>قبلا ثبت نام کردی؟ <a href='$loginPage'>وارد شو</a></p>";
	
		if ($_SESSION['alert'] ==4){
			echo "<script> swal('تبریک!','شماره همراه شما تایید شد', 'success'); </script>";
		}
		else if ($_SESSION['alert'] ==6){
			echo "<script> swal('متاسفیم!','شماره همراه شما هنوز تایید نشده است', 'success'); </script>";
		}
		unset($_SESSION['alert']);
    ?>
  </div>
</form>

</body>
</html>
