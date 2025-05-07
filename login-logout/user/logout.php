<?php 
	session_start();
    //echo "alert('salam')";
    if (isset($_SESSION['email'])) {
        echo "you are logged out successfully";
        unset($_SESSION['email']);
        header("Location: https://hamedesmaili.com/register/login.php");
    } else {
        echo "you are not logged in to be logged out!";
        die();
    }
?>