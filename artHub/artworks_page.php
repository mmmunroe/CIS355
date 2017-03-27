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
                <h3>Artworks</h3>
            </div>
            <div class="row">
                <p>
                    <a href="art_create.php" class="btn btn-success">Create new Artwork Description</a>
                </p>
                 
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Title</th>
                          <th>Description</th>
                          <th>Date Created</th>
						  <th>Price</th>
						  <th>Size</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM artworks ORDER BY id DESC';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['title'] . '</td>';
                                echo '<td>'. $row['description'] . '</td>';
                                echo '<td>'. $row['date_created'] . '</td>';
								echo '<td>'. $row['price'] . '</td>';
								echo '<td>'. $row['size'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="art_read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="art_update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="art_delete.php?id='.$row['id'].'">Delete</a>';
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
