<?php
    function connectToDB() {
        $servername = "localhost:3306";
        $username = "root";
        $password = "";
        $dbname = "azmun";
        $conn = new mysqli("localhost", "testuser", "eD5i8y5~", "azmun");

        return $conn;
    }
?>