<?php 
  session_start();  
  var_dump($_SESSION);
  // Redirect to a page
  //---------------------------------------------------------------------------------------
  if (isset($_SESSION['email'])) {
    header("Location: http://localhost/azmunonline/azmun/index.html");
    die();
  }

  if (isset($_SESSION['verified'])) {
      header("Location: http://localhost/azmunonline/index.php");
      die();
  }  

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
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

<form action="http://localhost/azmunonline/send_code.php" method="POST">
  <div class="container">
    <h1>ثبت نام</h1>
    <p>لطفا برای ادامه شماره همراهتان را وارد کنید</p>
    <hr>
	
    <label for="phone"><b>تلفن همراه</b></label>
    <input type="text" placeholder="Phone" name="phone" id="phone" required>
    <hr>
    <button type="submit" class="registerbtn">ارسال کد تایید</button>
</form>
<form action="http://localhost/azmunonline/verify_code.php" method="GET">
  <hr>

    <?php 
      if (!isset($_SESSION['phone'])) {
        echo '<label for="phone"><b>تلفن همراه</b></label> 
            <input type="text" placeholder="Phone" name="phone" id="phone" required>';
      }
    ?>

    <label for="code"><b>کد تایید</b></label>
    <input type="text" placeholder="کد تایید بعد از وارد کردن شماره برایتان ارسال می شود." name="code" id="code" required>
    
   

    

  <hr>


    <button type="submit" class="registerbtn">تکمیل فرایند ثبت نام</button>
  </div>
  
  <div class="container signin">
    <p>قبلا ثبت نام کردی؟ <a href="https://hamedesmaili.com/register/login.php">وارد شو</a></p>
  </div>
</form>

</body>
</html>
