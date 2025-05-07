<head> 
    <meta charset = "UTF-8">
</head>
<?php


    // Validate SESSION and POST is set
    //---------------------------------------------------------------------------------------
    session_start();
    var_dump($_POST);
    var_dump($_SESSION);
    if (!isset($_SESSION['phone']) and !isset($_POST['phone'])) {
        header("Location: register.php?error='Enter phone'");
    }

    if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
        header("Location: register.php?error='Enter all fields'");
    }

    //---------------------------------------------------------------------------------------
     

    // Validate name, email, password for registration
    //---------------------------------------------------------------------------------------
    //haraye in ghesmat badan az modjule amade estefade mishe
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
        header("Location: register.php?error='$error'");
    } 
    echo "Connected successfully<br>";
    //---------------------------------------------------------------------------------------



    // Validate phone
    //---------------------------------------------------------------------------------------
    if (isset($_POST['phone']))
        $phone = $_POST['phone'];
    else if (isset($_SESSION['phone']))
        $phone = $_SESSION['phone'];

    $sql = "SELECT id FROM phone WHERE phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_row();
        $phone_id = $row[0] + 0;
    } else {
        $error = 'Phone e dakhele session/post dar database mojood nist';
        //header("Location: register.php?error='$error'");
    }

    $sql = "SELECT * FROM user_phone WHERE pid = '$phone_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error = "Ba phone e dakhele session ghablan account sakhte shode";
        //header("Location: register.php?error='$error'");
    }
    //---------------------------------------------------------------------------------------



    // Insert user to DB
    //---------------------------------------------------------------------------------------
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $sql =  "INSERT INTO user (name, email, password) VALUES ('$user_name', '$user_email', '$user_password')";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $error = 'Error 000';
        //header("Location: register.php?error='$error'");
        //Age errore 000 rokh bede, kafie  dobare sabte nam surat begire va moshkel critical nist
    }

    $sql =  "SELECT id FROM user WHERE email = '$user_email'";

    $result = $conn->query($sql);

    $row = $result->fetch_row();
    $user_id = $row[0] + 0;

    $sql =  "INSERT INTO user_phone (uid, pid) VALUES ($user_id, $phone_id)";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $error = 'Error 001';
        //header("Location: register.php?error='$error'");
        //Age errore 001 rokh bede bayad usere sakhte shode shode be surate dasti (automate) az DB hazf she [critical error]
        
    }

    echo "Operation barbossa was successful... 4 am sobh";
    header("Location: http://localhost/azmunonline/index.php");
    $_SESSION['email'] = $user_email;
    //---------------------------------------------------------------------------------------

    $conn->close();

?>