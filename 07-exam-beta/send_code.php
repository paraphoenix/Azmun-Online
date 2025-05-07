<head> 
    <meta charset = "UTF-8">
</head>
<?php
    // Includes
    include("settings.php");  
    include("RemotePost.php");

    // validate POST is set
    //---------------------------------------------------------------------------------------
    session_start();

    if (!isset($_POST['phone'])) {
        $error = 'shomare hamrah vared nashode';
        echo $error;
        die();
    }

    $phone = $_POST['phone'];
    //---------------------------------------------------------------------------------------



    //---------------------------------------------------------------------------------------
    //Validate phone number
    //---------------------------------------------------------------------------------------



    // connect to DB
    //---------------------------------------------------------------------------------------
    $conn = connectToDB();
    //---------------------------------------------------------------------------------------


    // connect to SMS Remote Post
    //---------------------------------------------------------------------------------------
    $remotePost=new RemotePost("pargar2","par1234");
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
            $error = 'in shomare ghablan verify shode';
            echo $error;
            die();
        } else {
            $sql = "UPDATE phone SET code = $code WHERE phone = '$phone'";
            if ($conn->query($sql) === TRUE) {
                $error = "Code jadid baraye shomareye $phone sader shod";
                echo $error;
                $msg = "کد تایید شما: " . " $code";
                $remotePost->SendCustomMessage("$phone", "$msg");
                die();
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
                echo $error;
                die();
            }
        }
    } else {
        $sql = "INSERT INTO phone (phone, code) VALUES ('$phone', $code)";
        if ($conn->query($sql) === TRUE) {
            $error = "Code baraye avalin bar beshomareye $phone sader shod" . "<br>";
            echo $error;
            $msg = "کد تایید شما: " . " $code";
            $remotePost->SendCustomMessage("$phone", "$msg");
            die();
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
            echo $error;
            die();
        }
    }
    $conn->close();
    //---------------------------------------------------------------------------------------

?>
