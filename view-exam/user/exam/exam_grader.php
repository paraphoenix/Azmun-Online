<?php 
    // Includes
    include("../../register/settings.php");  


    // validate POST is set
    //---------------------------------------------------------------------------------------
    if (!isset($_POST["answers"])) {
        echo "POST[answers] is empty";
        die();
    } 
    //---------------------------------------------------------------------------------------



    // Connect to DB
    //---------------------------------------------------------------------------------------
    //$conn = connectToDB();
    //---------------------------------------------------------------------------------------



    // Insert each choice to DB
    //---------------------------------------------------------------------------------------
    $answers = $_POST["answers"];
    $err_cnt = 0;
    $succ_cnt = 0;
    $update_cnt = 0;
    $insert_cnt = 0;
    for ($i = 0; $i < count($answers); $i++) {
        $q_number = $i + 1;
        $u_id = 21;
        $user_choice = $answers[$i];

        $sql = "SELECT * FROM user_question WHERE u_id = $u_id AND q_number = $q_number";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $sql = "UPDATE user_question SET user_choice = $user_choice WHERE u_id = $u_id AND q_number = $q_number";
            $result = $conn->query($sql);
            $update_cnt += 1;
        } else {
            $sql =  "INSERT INTO user_question (u_id, q_number, user_choice) VALUES ($u_id, $q_number, $user_choice)";
            $result = $conn->query($sql);
            $insert_cnt += 1;
        }
            
        if ($result === FALSE) {
            $err_cnt += 1;
        } else {
            $succ_cnt += 1;
        }
    }
    echo "err_cnt: " . $err_cnt . "|" . "success_cnt: " . $succ_cnt . "|";
    echo "update_cnt: " . $update_cnt . "|" . "insert_cnt: " . $insert_cnt . "|";
    //---------------------------------------------------------------------------------------
?>