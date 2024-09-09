<?php
	// session_start();

	$con = mysqli_connect("localhost", "root", "", "stellive");

	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
		exit();
	}

?>