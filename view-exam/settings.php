<?php
    $registerPage = "register.php";
    $loginPage = "login.php";
    $phonePage = "phone.php";
    $registerUserPage = "register_user.php";
    $loginUserPage = "login_user.php";
    $sendCodePage = "send_code.php";
    $verifyCodePage = "verify_code.php";
    $mainPage = "main.php";
    $userPage = "https://hamedesmaili.com/user/user.php";

    function PATH() {
        //return "http://localhost/azmunOnline/links-fixed/";
        return "https://hamedesmaili.com/register/";
    }

    function getPath($fileName) {
        $PATH = PATH();
        $fullPath = $PATH . $fileName;
        return $fullPath;
    }

    function redirect($fileName) {
        $fullPath = getPath($fileName);
        //echo $fullPath;
        header("Location: $fullPath"); die();
    }

    function doRedirects() {
        session_start();
        if (isset($_SESSION['email'])) {
            header("Location: https://hamedesmaili.com/user/user.php");
            die();
        }
    }

    function connectToDB() {
        $servername = "localhost:3306";
        $username = "root";
        $password = "";
        $dbname = "azmun";


        $conn = new mysqli("localhost", "testuser", "eD5i8y5~", "azmun");
        //$conn = new mysqli("localhost", "root", "", "azmun");
		mysqli_query($conn,"SET CHARACTER SET utf8;");
		mysqli_query($conn,"SET NAMES utf8");
        return $conn;

        /*$conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            $error = "Connection failed: " . $conn->connect_error;
            return $error;
        } else {
            return 'success';
        }*/
    }

    function englishNumber($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic =  ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];
        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);
    
        return $englishNumbersOnly;
    }

    function format2TimeStamp($formattedTime) {
        $format = "Y-m-d H:i:s";
        $formattedTime = DateTime::createFromFormat($format, $formattedTime);
        $formattedTime = $formattedTime->getTimestamp();
        return $formattedTime;
    }
?>