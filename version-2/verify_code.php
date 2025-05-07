<head> 
    <meta charset = "UTF-8">
</head>
<?php
    session_start();
    var_dump($_GET);
    var_dump($_SESSION);
    if (!isset($_SESSION['phone']) and !isset($_GET['phone'])) {
        header("Location: http://localhost/azmunonline/register.php");
        die("shomare shoma dar session sabt nashode <br>");
    }
    if (!isset($_GET['code'])) {
        header("Location: http://localhost/azmunonline/register.php");
        die("code 6 raghami vared nashode <br><br>");
    }

    if (isset($_SESSION['phone']))
        $phone = $_SESSION['phone'];
    else   
        $phone = $_GET['phone'];

    $code = $_GET['code'];
    //$code = 252462;
    echo "shomare shoma: ".$phone.'<br>';
    echo "code vared shode az janebe shoma: ".$code.'<br>';


    //Check if phone already exist
    //---------------------------------------------------------------------------------------
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "azmun";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        header("Location: http://localhost/azmunonline/register.php");
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected successfully";
    }
    echo '<br><br>';

    $sql = "SELECT * FROM phone WHERE phone = '$phone'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_row();
        var_dump($row);
        $realCode = $row[2];
        $isVerified = $row[3];
        if ($isVerified == '1') {
            header("Location: http://localhost/azmunonline/login.php");
            die("in shomare ghablan verify shode");
        }
        if ($realCode == $code) {
            echo "<b>"."code vared shode SAHIH ast"."<b>";
            $sql = "UPDATE phone SET verified = 1 WHERE phone = '$phone'";

            if ($conn->query($sql) === TRUE) {
              echo "<br>shomareye shoma ba movafaghiat verify shod";
              header("Location: http://localhost/azmunonline/login.php");
              die();
            } else {
                header("Location: http://localhost/azmunonline/register.php");
                die("Error updating record: " . $conn->error) . "<br>";
            }
        } else {
            header("Location: http://localhost/azmunonline/login.php?error='code is wrong'"); /////////*** ino badan bayad alert she **/////////////////
            die("<b>"."code vared shode GHALAT ast"."<b>");
        }
    } else {
        echo "shomare zakhire shode dar session dar database nist";
        unset($_SESSION['phone']);
        header("Location: http://localhost/azmunonline/index.php");
        die();
    }

    echo '<br><br>';

    $conn->close();
    
    //---------------------------------------------------------------------------------------
?>
<a href = "http://localhost/azmunonline/phone.php"> بازگشت </a>
