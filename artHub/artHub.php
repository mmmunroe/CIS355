<?php
	session_start();
	if (empty($_SESSION['userid']))
		login();

	function login() {
		echo '<form action="login_form.php" method="post">';
		echo '<p>Email: ';
		echo '<input type="text" name="email"><br>'; 				
		echo '<p>Password: ';
		echo '<input type="password" name="password"><br>';
		echo 'input type="submit" value="Submit">';
		echo '</form>'; 				
	}
?>
