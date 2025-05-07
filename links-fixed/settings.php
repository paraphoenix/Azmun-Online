<?php
    $registerPage = "register.php";
    $loginPage = "login.php";
    $phonePage = "phone.php";
    $registerUserPage = "register_user.php";
    $loginUserPage = "login_user.php";
    $sendCodePage = "send_code.php";
    $verifyCodePage = "verify_code.php";
    $mainPage = "main.php";

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
            redirect("azmun/index.html");
        }
    }

    function connectToDB() {
        $servername = "localhost:3306";
        $username = "root";
        $password = "";
        $dbname = "azmun";


        $conn = new mysqli("localhost", "testuser", "eD5i8y5~", "azmun");
        //$conn = new mysqli("localhost", "root", "", "azmun");

        return $conn;

        /*$conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            $error = "Connection failed: " . $conn->connect_error;
            return $error;
        } else {
            return 'success';
        }*/
    }
?>