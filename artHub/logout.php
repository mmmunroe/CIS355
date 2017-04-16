<?php
	/* ---------------------------------------------------------------------------
	* filename    : logout.php
	* description : allows user to log out.
	* ---------------------------------------------------------------------------
	*/

	session_start();
	session_destroy();
	header("Location: login.php");
?>
