<?php
    // Includes
    include("../../register/settings.php");  


    // validate POST is set
    //---------------------------------------------------------------------------------------
    if (!isset($_GET["e_id"])) {
        echo "GET[e_id] is empty";
        die();
    } 
    //---------------------------------------------------------------------------------------


    // Connect to DB
    //---------------------------------------------------------------------------------------
    $conn = connectToDB();
    //---------------------------------------------------------------------------------------

    // Create user_exam
    //---------------------------------------------------------------------------------------
    $e_id = $_GET['e_id'];

    $sql = "SELECT * FROM exam WHERE id = $e_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_row();
        $timeNow = time();
        $duration = $row[4];
        $startTime = $row[5];
        $finishTime = $row[6];
        $isActive = $row[7];
        $userExamStartTime = $timeNow + 60;
        $userExamFinishTime = $userExamStartTime + $duration * 60;

        if ($isActive != '1') {
            echo "exam is not active";
            die();
        }

        if ($timeNow < $startTime) {
            echo "exam has not yet started";
            die();
        }

        if ($timeNow > $finishTime) {
            echo "exam has finished";
            $sql = "UPDATE exam SET is_active = '0' WHERE id = $e_id";
            $result = $conn->query($sql);
            die();
        }

        session_start();

        if (!isset($_SESSION['email'])) {
            echo "You are not logged in";
            die();
        }

        $user_email = $_SESSION['email'];
        $sql = "SELECT * FROM user WHERE email = '$user_email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_row();
            $u_id = $row[0];
        } else {
            echo "Error 004";
            unset($_SESSION['email']);
            die();
            // Error 004 yani emaili ke tuye session mojud hast namotabar hast ya user ba in email dar db pak shode
        }
        $sql = "SELECT * FROM user_exam WHERE u_id = $u_id AND exam_id = $e_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "you have already registered on exam";
            header("Location: https://hamedesmaili.com/user/exam/");
            die();
        }

        $sql =  "INSERT INTO user_exam (u_id, exam_id, start_time, finish_time) VALUES ($u_id, $e_id, $userExamStartTime, $userExamFinishTime)";
        $result = $conn->query($sql);
        if ($result === FALSE) {
            $error = "Error: " . $sql . "<br>" . $conn->error;
            echo $error;
            die();
        } else {
            echo "user registered in exam successfully";
            header("Location: https://hamedesmaili.com/user/exam/");
        }
    } else {
        echo "exam with this e_id not found";
        die();
    }
    //---------------------------------------------------------------------------------------

?>