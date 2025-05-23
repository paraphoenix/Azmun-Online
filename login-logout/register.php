<?php 
  // Includes
  include("settings.php");  
  
  // Redirect to a page
  doRedirects();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset = "UTF-8">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
  direction:rtl;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
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
