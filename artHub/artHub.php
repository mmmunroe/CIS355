<?php 
	/* ---------------------------------------------------------------------------
	* filename    : artHub.php
	* description : Home page which allows user to create an account, if needed.
	* ---------------------------------------------------------------------------
	*/

	session_start();
	if(!isset($_SESSION['artist_id'])){ // if artist not set,
		if(!isset($_SESSION['patron_id'])) { // or if patron not set,
			session_destroy();
			header('Location: login.php');   // go to login page
			exit;
		}
	}

?>

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
   		<p>
			<a href="logout.php" class="btn btn-danger">Log out</a>
		</p>
		<p>
        	<a href="artist_create.php" class="btn btn-primary">Create new Artist Account</a>
        </p>
		<p>
			<a href="patron_create.php" class="btn btn-info">Create new Patron Account</a>
		</p>
        </div>
    </div> <!-- /container -->
  </body>
</html>
