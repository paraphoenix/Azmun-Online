<?php 
  session_start();
  var_dump($_SESSION);
  // Redirect to a page
  //---------------------------------------------------------------------------------------
  if (isset($_SESSION['email'])) {
    header("Location: http://localhost/azmunonline/azmun/index.html");
    die();
  }
  if (!isset($_SESSION['phone'])) {
    header("Location: http://localhost/azmunonline/phone.php");
    die();
  }  
  if (isset($_SESSION['verified'])) {
    if ($_SESSION['verified'] == '1') {
      header("Location: http://localhost/azmunonline/login.php");
      die();
    }  else {
      header("Location: http://localhost/azmunonline/register.php");
      die();
    }
  }
  //---------------------------------------------------------------------------------------

  // connect to DB
  //---------------------------------------------------------------------------------------
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "azmun";


  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    echo("Connection failed: " . $conn->connect_error);
  } else {
    echo "Connected successfully";
  }
  echo '<br>';
  //---------------------------------------------------------------------------------------

  // set verified session
  //---------------------------------------------------------------------------------------
  $phone = $_SESSION['phone'];

  $sql = "SELECT verified FROM phone WHERE phone = '$phone'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_row();
    $verified = $row[0];
    if ($verified == '1') {
      $_SESSION['verified'] = '1';
      header("Location: http://localhost/azmunonline/register.php");
      die();
    }
    else  {
      $_SESSION['verified'] = '0';
      header("Location: http://localhost/azmunonline/phone.php");
      die();
    } 
  }
  else {
      echo "shomare zakhire shode dar session, dar database nist!";
      unset($_SESSION['phone']);
      header("Location: http://localhost/azmunonline/register.php");
      die();
    }

  //---------------------------------------------------------------------------------------

?>
