<head> 
    <meta charset = "UTF-8">
</head>
<?php
    // Includes
    include("settings.php");  

    // validate POST is set
    //---------------------------------------------------------------------------------------
    $fields = array ("phone", "password");

    foreach ($fields as &$value) {
        if (!isset($_POST[$value])) {
            $error = "$value vared nashode";
            echo $error;
            die();
        }
    }

    $phone = $_POST['phone'];
    $user_password = $_POST['password'];
    //--------------------------------------------------------------------------------------- 



    // Connect to DB
    //---------------------------------------------------------------------------------------
    $conn = connectToDB();
    //---------------------------------------------------------------------------------------


    // Select user from DB
    //---------------------------------------------------------------------------------------
    $sql = "SELECT id FROM phone WHERE phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        $error = "shomareye vared shode peyda nashod";
        echo $error;
        die();
    }

    $row = $result->fetch_row();
    $phone_id = $row[0] + 0;

    $sql = "SELECT uid FROM user_phone WHERE pid = '$phone_id'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        $error = "Error 002";
        echo $error;
        die();
        // Error 002 yani dar table user_phone ye user vojood nadare (pak shode) ke bayad dasti ya automate ezafe she
        // Error 002 mitune bekhatere in bashe ke karbar hanuz shomare ro tayid nakarde
    }

    
    $row = $result->fetch_row();
    $user_id = $row[0] + 0;

    $sql = "SELECT * FROM user WHERE id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        $error = "Error 003";
        echo $error;
        die();
        // Error 003 yani dar table user_phone ye satri vojood dare ke uid e un dar table user ha nist (pak shode)
    }

    $row = $result->fetch_row();
    $real_password = $row[3]; 
    $user_email = $row[2];   
    //---------------------------------------------------------------------------------------



    // Validate password and login
    //---------------------------------------------------------------------------------------
    if ($user_password == $real_password) {
        session_start();
        echo "login was successful";
        $_SESSION['email'] = $user_email;
        header("Location: https://hamedesmaili.com/user/user.php");
    } else {
        $error = "wrong password";
        echo $error;
        die();
    }
    //---------------------------------------------------------------------------------------

    $conn->close();
?>