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
<!--
		<?php
    		if(isset($_SESSION['message']))
    		{
         		echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         		unset($_SESSION['message']);
    		}
		?>
	<form method="post" action="login.php">
  		<table>
     	<tr>
           <td>Name : </td>
           <td><input type="text" name="username" class="textInput"></td>
     	</tr>
      	<tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     	</tr>
      	<tr>
           <td></td>
           <td><input type="submit" name="login_btn" class="Log In"></td>
     	</tr>
		</table>
   		<p>
			<a href="logout.php" class="btn btn-danger">Log out</a>
		</p>
-->
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
