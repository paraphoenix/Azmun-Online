<head> 
    <meta charset = "UTF-8">
</head>
<?php


    // Validate POST is set
    //---------------------------------------------------------------------------------------
    session_start();
    var_dump($_POST);
    var_dump($_SESSION);
    if (!isset($_POST['phone']) and !isset($_POST['password'])) {
        header("Location: http://localhost/azmunonline/login.php?error='phone or password not set.'");
        die("phone or password not set.");
    }
    //---------------------------------------------------------------------------------------
   

    // Connect to DB
    //---------------------------------------------------------------------------------------
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "azmun";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        $error = "Connection failed: " . $conn->connect_error;
        header("Location: http://localhost/azmunonline/login.php?error='$error'");
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "Connected successfully<br>";
    //---------------------------------------------------------------------------------------


    // Select user from DB
    //---------------------------------------------------------------------------------------
    $phone = $_POST['phone'];

    $sql = "SELECT id FROM phone WHERE phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        header("Location: http://localhost/azmunonline/login.php?error='user with this phone not found'");
        die("User with this phone not found.");
    }


    $row = $result->fetch_row();
    $phone_id = $row[0] + 0;

    die();

    $sql = "SELECT uid FROM user_phone WHERE pid = '$phone_id'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        header("Location: http://localhost/azmunonline/login.php?error='Error 002'");
        die("Error 002");
        // Error 002 yani dar table user_phone ye user vojood nadare (pak shode) ke bayad dasti (automate) ezafe she
    }

    
    $row = $result->fetch_row();
    $user_id = $row[0] + 0;

    $sql = "SELECT * FROM user WHERE id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        header("Location: http://localhost/azmunonline/login.php?error='Error 002'");
        die("Error 002");
        // Error 002 yani dar table user_phone ye user vojood nadare (pak shode) ke bayad dasti (automate) ezafe she
    }

    $row = $result->fetch_row();
    $real_password = $row[3]; 
    $user_email = $row[2];   
    //---------------------------------------------------------------------------------------



    // Validate password and login
    //---------------------------------------------------------------------------------------
    $user_password = $_POST['password'];
    if ($user_password == $real_password) {
        $_SESSION['email'] = $user_email;
        echo 'saat 6 am e khabam miad ensafan azyat nakon o run sho';
        header("Location: http://localhost/azmunonline/azmun/index.html");

    } else {
        die('wrong password');
        header("Location: http://localhost/azmunonline/login.php?error='wrong password'");
    }
    //---------------------------------------------------------------------------------------

?>