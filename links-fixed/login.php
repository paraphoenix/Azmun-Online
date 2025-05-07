<?php 
  // Includes
  include("settings.php");  
  
  // Redirect to a page
  doRedirects();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  
  direction:rtl;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
	width:80%;
  margin:auto;
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
@import url('https://fonts.googleapis.com/css2?family=Lalezar&display=swap');

body {
  font-family: 'Lalezar', cursive !important;
  }
  
.lale{
	font-family: 'Lalezar', cursive !important;
}
</style>
</head>
<body>

<?php echo "<form action='$loginUserPage' method='POST'>" ?>
  <div class="container">
    <h1>ورود</h1>
    
    <hr>
	
    <label for="phone"><b>تلفن همراه</b></label>
    <input class="lale" type="text" placeholder="Phone" name="phone" id="phone" required>
    
    <label for="password"><b>رمز</b></label>
    <input class="lale" type="password" placeholder="Password" name="password" id="password" required>

    

    <hr>


    <button type="submit" class="registerbtn lale">ورود</button>
  </div>
  
  <div class="container signin">
  <?php
      echo "<p>شماره تو تایید نکردی؟<a href='$phonePage'> شماره تو تایید کن</a></p>";
      echo "<p>قبلا شماره تو تایید کردی‌؟ <a href='$registerPage'>ثبت نام کن</a></p>";
      //echo "<p>قبلا ثبت نام کردی؟ <a href='$loginPage'>وارد شو</a></p>";
  ?>
  </div>
</form>

</body>
</html>
