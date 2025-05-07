<head> 
    <meta charset = "UTF-8">
</head>
<?php
    // Includes
    include("settings.php");  

    // validate POST is set
    //---------------------------------------------------------------------------------------
    $fields = array ("name", "email", "phone", "password");

    foreach ($fields as &$value) {
        if (!isset($_POST[$value])) {
            $error = "$value vared nashode";
            echo $error;
            die();
        }
    }

    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_password = $_POST['password'];
    //--------------------------------------------------------------------------------------- 

    // Validate name, email, password for registration
    //---------------------------------------------------------------------------------------
    //baraye in ghesmat badan az modjule amade estefade mishe
    //---------------------------------------------------------------------------------------


    // Connect to DB
    //---------------------------------------------------------------------------------------
    $conn = connectToDB();
    //---------------------------------------------------------------------------------------



    // Validate phone
    //---------------------------------------------------------------------------------------
    $sql = "SELECT * FROM phone WHERE phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_row();
        $phone_id = $row[0] + 0;
        $isPhoneVerified = $row[3];
        if ($isPhoneVerified == '0') {
            $error = "Shomareye vared shode tayid nashode";
            echo $error;
            die();
        }
    } else {
        $error = 'Shomareye vared shode peyda nashod';
        echo $error;
        die();
    }

    $sql = "SELECT * FROM user_phone WHERE pid = '$phone_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error = "Ba shomareye e vared shode ghablan account sakhte shode";
        echo $error;
        die();
    }
    //---------------------------------------------------------------------------------------

    // Insert user to DB
    //---------------------------------------------------------------------------------------
    $sql =  "INSERT INTO user (name, email, password) VALUES ('$user_name', '$user_email', '$user_password')";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        echo $error;
        die();
    }

    $sql =  "SELECT id FROM user WHERE email = '$user_email'";

    $result = $conn->query($sql);

    $row = $result->fetch_row();
    $user_id = $row[0] + 0;

    $sql =  "INSERT INTO user_phone (uid, pid) VALUES ($user_id, $phone_id)";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        $error = "Error 001";
        echo $error;
        die();
        //echo "Error: " . $sql . "<br>" . $conn->error;
        //Age errore 001 rokh bede bayad usere sakhte shode shode be surate dasti (automate) az DB hazf she [critical error]
        
    }

    echo "Karbar ba movafaghiat sakhte shod";
    //---------------------------------------------------------------------------------------

    $conn->close();

?>