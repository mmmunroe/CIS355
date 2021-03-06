<?php
	/* ---------------------------------------------------------------------------
	* filename    : artist_read.php
	* description : allows user to view an artist account.
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

    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: artists_page.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM artists where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
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
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Read an Artist</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['name'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['email'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Experience Level</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['experience'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="artists_page.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
