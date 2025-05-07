<?php 
    // Includes
    include("../../register/settings.php");  


    // validate POST is set
    //---------------------------------------------------------------------------------------
    if (!isset($_POST["answers"])) {
        echo "POST[answers] is empty";
        die();
    } 

    if (!isset($_POST["exam_id"])) {
        echo "POST[exam_id] is empty";
        die();
    } 
    $exam_id = $_POST["exam_id"] + 0;
    //---------------------------------------------------------------------------------------



    // Connect to DB
    //---------------------------------------------------------------------------------------
    $conn = connectToDB();
    //---------------------------------------------------------------------------------------

    // Select user data from DB
    //---------------------------------------------------------------------------------------
    session_start();
    if (!$_SESSION['email']) {
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


    // Insert each choice to DB
    //---------------------------------------------------------------------------------------
    $answers = $_POST["answers"];
    $err_cnt = 0;
    $succ_cnt = 0;
    $update_cnt = 0;
    $insert_cnt = 0;
    for ($i = 0; $i < count($answers); $i++) {
        $q_number = $i + 1;
        $user_choice = $answers[$i];

        $sql = "SELECT * FROM user_question WHERE u_id = $u_id AND q_number = $q_number";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $sql = "UPDATE user_question SET user_choice = $user_choice WHERE u_id = $u_id AND q_number = $q_number";
            $result = $conn->query($sql);
            $update_cnt += 1;
        } else {
            $sql =  "INSERT INTO user_question (u_id, exam_id, q_number, user_choice) VALUES ($u_id, $exam_id, $q_number, $user_choice)";
            $result = $conn->query($sql);
            $insert_cnt += 1;
        }
            
        if ($result === FALSE) {
            $err_cnt += 1;
        } else {
            $succ_cnt += 1;
        }
    }

    // End exam if necessary
    //---------------------------------------------------------------------------------------
    if (isset($_POST['end_exam'])) {
        $end_exam = $_POST['end_exam'];
        if ($end_exam == '1') {
            $sql = "UPDATE user_exam SET finish_time = '1' WHERE u_id = $u_id AND exam_id = $exam_id";
            $result = $conn->query($sql);

            if ($result === FALSE) {
                echo "couldn't finish exam";
                //$error = "Error: " . $sql . "<br>" . $conn->error;
                //echo $error;
                die();
            }
            
        }
    }
    //---------------------------------------------------------------------------------------

    echo "exam saved successfully";
    //echo "err_cnt: " . $err_cnt . "|" . "success_cnt: " . $succ_cnt . "|";
    //echo "update_cnt: " . $update_cnt . "|" . "insert_cnt: " . $insert_cnt . "|";
    //---------------------------------------------------------------------------------------
?>