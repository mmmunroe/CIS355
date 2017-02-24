<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
 
<body>
	<div class="container">

		<!-- From w3schools -->
		<nav class="navbar navbar-default">
  			<div class="container-fluid">
   	 			<div class="navbar-header">
      				<a class="navbar-brand" href="artHub.php">Art Hub</a>
    			</div>
    		<ul class="nav navbar-nav">
      			<li class="active"><a href="artHub.php">Home</a></li>
      			<li><a href="artworks_page.php">Browse Art</a></li>
      			<li><a href="artists_page.php">Browse Artists</a></li>
      			<li><a href="patrons_page.php">Browse Patrons</a></li>
    		</ul>
  			</div>
		</nav>
        <div class="row">
        	<h3>Welcome</h3>

		<?php

    		include 'database.php';

    		session_start();
    		if (empty($_SESSION['userid']))
        		login();

    		function login() {
				echo '<label>Please log in</label>';
        		echo '<form action="login_form.php" method="post">';
        		echo '<label>Email: ';
        		echo '<input type="text" name="email"><br>';
        		echo '<p>Password: ';
        		echo '<input type="password" name="password"><br>';
        		echo '<input id="button" type="submit" name="submit" value="Log-In">';
        		echo '</form>';
    		}
		?>

        </div>
    </div> <!-- /container -->
  </body>
</html>
