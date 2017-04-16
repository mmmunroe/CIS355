<?php 
	/* ---------------------------------------------------------------------------
	* filename    : patrons_page.php
	* description : allows user to browse patrons.
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
                <h3>Patrons</h3>
            </div>
            <div class="row">
                <p>
                    <a href="patron_create.php" class="btn btn-success">Create new Patron</a>
                        <a href="logout.php" class="btn btn-danger">Log out</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email Address</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM patrons ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['name'] . '</td>';
                                echo '<td>'. $row['email'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="patron_read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="patron_update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="patron_delete.php?id='.$row['id'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
