<head> 
    <meta charset = "UTF-8">
</head>
<?php

    // validate POST is set
    //---------------------------------------------------------------------------------------
    session_start();
    var_dump($_POST);
    var_dump($_SESSION);
    if (!isset($_POST['phone'])) {
        $error = 'shomare hamrah vared nashode';
        header("Location: https://localhost/azmunonline/phone.php?error='$error'");
    }

    $phone = $_POST['phone'];
    //---------------------------------------------------------------------------------------



    //---------------------------------------------------------------------------------------
    //Validate phone number
    //---------------------------------------------------------------------------------------



    // connect to DB
    //---------------------------------------------------------------------------------------
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "azmun";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        $error = "Connection failed: " . $conn->connect_error;
        header("Location: https://localhost/azmunonline/phone.php?error='$error'");
    } else {
        echo "Connected successfully";
    }
    echo '<br>';
    //---------------------------------------------------------------------------------------


    // connect to SMS Remote Post
    //---------------------------------------------------------------------------------------
    //include("RemotePost.php");
    //$remotePost=new RemotePost("pargar2","par1234");
    //---------------------------------------------------------------------------------------


    // send Code
    //---------------------------------------------------------------------------------------
    $sql = "SELECT * FROM phone WHERE phone = '$phone'";

    $result = $conn->query($sql);
    $code = rand(100000, 999999);



    if ($result->num_rows > 0) {
        $row = $result->fetch_row();
        $phone = $row[1];
        $verified = $row[3];
        if ($verified == '1') {
            $_SESSION['phone'] = $phone;
            $error = 'in shomare ghablan verify shode';
            //header("Location: https://localhost/azmunonline/phone.php?error='$error'");
        }
        $sql = "UPDATE phone SET code = $code WHERE phone = '$phone'";
        if ($conn->query($sql) === TRUE) {
            echo "Code jadid baraye shomareye $phone sader shod";
            //echo ($remotePost->SendCustomMessage("$phone","$code"));
            $_SESSION['phone'] = $phone;
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
            //header("Location: https://localhost/azmunonline/phone.php?error='$error'");
        }
        
    } else {
        $sql = "INSERT INTO phone (phone, code) VALUES ('$phone', $code)";
        if ($conn->query($sql) === TRUE) {
            echo "Code baraye avalin bar beshomareye $phone sader shod";
            //echo ($remotePost->SendCustomMessage("$phone","$code"));
            $_SESSION['phone'] = $phone;
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
            //header("Location: https://localhost/azmunonline/phone.php?error='$error'");
        }
    }    
    //---------------------------------------------------------------------------------------

    $conn->close();
    header("Location: https://localhost/azmunonline/login.php");
?>
<a href = "http://localhost/azmunonline/phone.php"> بازگشت </a>
