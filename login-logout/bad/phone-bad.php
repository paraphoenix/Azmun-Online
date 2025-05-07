<?php 
  // Includes
  include("settings.php");  
  
  // Redirect to a page
  doRedirects();
?>

<!DOCTYPE html>
<html>
<?php echo "<form action='$sendCodePage' method='POST'>" ?>
  <div class="container ">
    <h1 >تایید شماره همراه</h1>
    <p>لطفا برای ادامه شماره همراهتان را وارد کنید</p>
    <hr>
	
    <label for="phone"><b>تلفن همراه</b></label>
    <input type="text" placeholder="مثال: 09121234567" name="phone" id="phone" required>
    <hr>
    <button type="submit" class="registerbtn">ارسال کد تایید</button>
</form>
<?php echo "<form action='$verifyCodePage' method='GET'>" ?>
  <hr>
    <label for="phone"><b>تلفن همراه</b></label> 
    <input type="text" placeholder="Phone" name="phone" id="phone" required>

    <label for="code"><b>کد تایید</b></label>
    <input type="text" placeholder="کد تایید بعد از وارد کردن شماره برایتان ارسال می شود." name="code" id="code" required>
    
   

    

  <hr>


    <button type="submit" class="registerbtn">تکمیل فرایند ثبت نام</button>
  </div>
  
  <div class="container signin">
    <?php
        //echo "<p>شماره تو تایید نکردی؟<a href='$phonePage'> شماره تو تایید کن</a></p>";
        echo "<p>قبلا شماره ات رو تایید کردی؟ <a href='$registerPage'>ثبت نام کن</a></p>";
        echo "<p>قبلا ثبت نام کردی؟ <a href='$loginPage'>وارد شو</a></p>";
    ?>
  </div>
	<?php
		session_start();
		if($_SESSION['alert'] ==1){
			echo "<script>swal('متاسفیم!', 'این شماره پیش از این تایید شده است', 'error'); </script>";
		}
		else if($_SESSION['alert'] ==2){
			echo "<script>swal('تبریک!', 'کد جدید با موفقیت برای شما ارسال شد', 'success'); </script>";
		}
		else if($_SESSION['alert'] ==3){
			echo "<script> swal('تبریک!','کد تایید با موفقیت برای شما ارسال شد', 'success'); </script>";
		}
		else if($_SESSION['alert'] ==5){
			echo "<script> swal('متاسفیم!','کد تایید وارد شده اشتباه است', 'error'); </script>";
		}
		else if($_SESSION['alert'] ==6){
			echo "<script> swal('متاسفیم!','لطفا شماره همراه خود را صحیح وارد کنید', 'error'); </script>";
		}
		unset ($_SESSION['alert']);

	?>
</form>

</body>
</html>
