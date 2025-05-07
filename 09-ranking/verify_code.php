<head> 
    <meta charset = "UTF-8">
</head>
<?php
    // Includes
    include("settings.php");  

    // validate POST is set
    //---------------------------------------------------------------------------------------
    if (!isset($_GET['phone'])) {
        $error = 'shomare hamrah vared nashode';
        echo $error;
        die();
    }

    if (!isset($_GET['code'])) {
        $error = 'code tayid vared nashode';
        echo $error;
        die();
    }

    $phone = $_GET['phone'];
    $code = $_GET['code'];
    //---------------------------------------------------------------------------------------



    // connect to DB
    //---------------------------------------------------------------------------------------
    $conn = connectToDB();
    //---------------------------------------------------------------------------------------

    // Phone and Code Verification
    //---------------------------------------------------------------------------------------
    $sql = "SELECT * FROM phone WHERE phone = '$phone'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_row();
        $realCode = $row[2];
        $isVerified = $row[3];
        if ($isVerified == '1') {
            $error = "in shomare ghablan verify shode";
            echo $error;
            die();
        } else {
            if ($realCode == $code) {
                $sql = "UPDATE phone SET verified = 1 WHERE phone = '$phone'";
                if ($conn->query($sql) === TRUE) {
                    $error ="shomareye shoma ba movafaghiat verify shod";
                    echo $error;
                    die(); 
                } else {
                    $error = "Error updating record: " . $conn->error;
                    echo $error;
                    die();
                }
            } else {
                $error = "code ghalat ast";
                echo $error;
                die();
            }
        }
    } else {
        $error = "shomare vared shode peyda nashod";
        echo $error;
        die();
    }
    
    $conn->close();
    //---------------------------------------------------------------------------------------

?>