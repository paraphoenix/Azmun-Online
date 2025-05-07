<head> 
    <meta charset = "UTF-8">
</head>
<?php
    // Includes
    include("../register/settings.php");  



    var_dump($_FILES);
    die();

    // validate POST is set
    //---------------------------------------------------------------------------------------
    $fields = array ("name", "test_cnt", "option_cnt", "duration", "start_time");

    foreach ($fields as &$value) {
        if (!isset($_POST[$value])) {
            $error = "$value vared nashode";
            echo $error;
            die();
        }
    }

    $name = $_POST['name'];
    $test_cnt = englishNumber($_POST['test_cnt']);
    $option_cnt = englishNumber($_POST['option_cnt']);
    $duration = englishNumber($_POST['duration']);
    $start_time = englishNumber($_POST['start_time']);
    $finish_time = englishNumber($_POST['finish_time']);

    //--------------------------------------------------------------------------------------- 



    // Connect to DB
    //---------------------------------------------------------------------------------------
    $conn = connectToDB();
    //---------------------------------------------------------------------------------------



    // validate form was sent by an admin
    //---------------------------------------------------------------------------------------
    session_start();
	if (isset($_SESSION['email'])) {
		$user_email = $_SESSION['email'];

		$sql = "SELECT * FROM user WHERE email = '$user_email'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_row();
			$is_user_admin = $row[6];
			if ($is_user_admin != '1') {
				echo "You don't have premission to create exam!";
				die();
			}
		} else {
			echo "Error 004";
			die();
			// Error 004 yani emaili ke tuye session mojud hast namotabar hast ya user ba in email dar db pak shode
		}
	} else {
		echo "You are not logged in!";
		die();
	}
    //---------------------------------------------------------------------------------------



    // Handle files
    //---------------------------------------------------------------------------------------
    $target_dir = "../files/exams/";
    $target_file = $target_dir . basename($_FILES["questions"]["name"]);
    echo $target_file;
    die();
    //---------------------------------------------------------------------------------------

    

    // Insert exam to DB
    //---------------------------------------------------------------------------------------
    $start_time = format2TimeStamp($start_time);
    $finish_time = format2TimeStamp($finish_time);
    $sql =  "INSERT INTO exam (name, test_cnt, option_cnt, duration, start_time, finish_time) VALUES ('$name', $test_cnt, $option_cnt, $duration, $start_time, $finish_time)";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        echo $error;
        die();
    } else {
        echo "Exam was created successfully";
    }
    //---------------------------------------------------------------------------------------
    $conn->close();
?>