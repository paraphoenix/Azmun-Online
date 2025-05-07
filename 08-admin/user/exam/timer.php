<?php
    include("../../register/settings.php");
    $conn = connectToDB();
    session_start();
    $user_email = $_SESSION['email'];
    $sql = "SELECT * FROM user WHERE email = '$user_email'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_row();
		$u_id = $row[0] + 0;
	} else {
		echo "Error 004";
		die();
		// Error 004 yani emaili ke tuye session mojud hast namotabar hast ya user ba in email dar db pak shode
    }
        
    $sql = "SELECT * FROM user_exam WHERE u_id = $u_id";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_row();
		$finishTime = $row[4] + 0;
	} else {
		echo "Error";
		die();
     }
?>
<?php    $exp_date = $finishTime;
    $now = time();

    if ($now < $exp_date) {
?>
<script>
// Count down milliseconds = server_end - server_now = client_end - client_now
    var server_end = <?php echo $exp_date; ?> * 1000;
    var server_now = <?php echo time(); ?> * 1000;
    var client_now = new Date().getTime();
    var end = server_end - server_now + client_now; // this is the real end time

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour *24
    var timer;

    function showRemaining()
    {
        var now = new Date();
        var distance = end - now;
        if (distance < 0 ) {
        clearInterval( timer );
        document.getElementById('countdown').innerHTML = 'EXPIRED!';

        return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor( (distance % _day ) / _hour );
        var minutes = Math.floor( (distance % _hour) / _minute );
        var seconds = Math.floor( (distance % _minute) / _second );

        var countdown = document.getElementById('countdown');
        countdown.innerHTML = '';
        if (days) {
            countdown.innerHTML += 'Days: ' + days + '<br />';
        }
        countdown.innerHTML += 'Hours: ' + hours+ '<br />';
        countdown.innerHTML += 'Minutes: ' + minutes+ '<br />';
        countdown.innerHTML += 'Seconds: ' + seconds+ '<br />';
    }

    timer = setInterval(showRemaining, 1000);
</script>
<?php
    } else {
        echo "Times Up";
    }
?>
<div id="countdown"></div>