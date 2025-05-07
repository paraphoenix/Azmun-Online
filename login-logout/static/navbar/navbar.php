<?php 

	// Connect to db
	$conn = connectToDB();

	// Select user data from DB
	//------------------------------------------------------------------------
	session_start();
	if (isset($_SESSION['email'])) {
		$user_email = $_SESSION['email'];

		$sql = "SELECT * FROM user WHERE email = '$user_email'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_row();
			$user_name = $row[1];
		} else {
			echo "Error 004";
			die();
			// Error 004 yani emaili ke tuye session mojud hast namotabar hast ya user ba in email dar db pak shode
		}
	} else {
		echo "You are not logged in!";
		die();
	}
	//------------------------------------------------------------------------
?>

<nav class="rtl navbar navbar-expand-md bg-dark navbar-dark mb-2">
	<a class="navbar-brand" href="#">شیمی پلاس</a>
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    	<span class="navbar-toggler-icon"></span>
  	</button>
 	 <div class="collapse navbar-collapse" id="collapsibleNavbar">
   		 <ul class="navbar-nav">
      		<li class="nav-item">
        		<a class="nav-link" href="../index.php">خانه</a>
      		</li>
			
			<li class='nav-item dropdown'>
				<?php echo "<a class='nav-link dropdown-toggle' href='#' id='navbardrop' data-toggle='dropdown'>$user_name</a>"; ?>
				<div class='dropdown-menu'>
					<a class='dropdown-item' href='#'>حساب کاربری</a>
				</div>
			</li>
    	</ul>
  </div>  
</nav>