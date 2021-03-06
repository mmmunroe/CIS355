<?php
	/* ---------------------------------------------------------------------------
	* filename    : art_read.php
	* description : allows user to view artwork description.
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
        header("Location: artworks_page.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM artworks where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);

		# get artist details
		$sql = "SELECT * FROM artists where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($data['artist_id']));
		$artistdata = $q->fetch(PDO::FETCH_ASSOC);

		# get patron details
		$sql = "SELECT * FROM patrons where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($data['patron_id']));
		$patrondata = $q->fetch(PDO::FETCH_ASSOC);

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
                        <h3>Read Art Descriptions</h3>
                    </div>
                     
                    <div class="form-horizontal" >

                      <div class="control-group">
                        <label class="control-label">Title</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['title'];?>
                            </label>
                        </div>
                      </div>


                      <div class="control-group">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['description'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Date Created</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['date_created'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['price'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Size</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['size'];?>
                            </label>
                        </div>
                      </div>

					<div class="control-group">
        <label class="control-label">Artist</label>
            <div class="controls">
                <label class="checkbox">
				<?php echo $artistdata['name'];?>
        		</label>
            </div>
 		</div>

				<div class="control-group">
    <label class="control-label">Patron</label>
        <div class="controls">
                <label class="checkbox">
                     <?php echo $patrondata['name'];?>
				</label>
        </div>
 </div>

                        <div class="form-actions">
                          <a class="btn" href="artworks_page.php">Back</a>
                       </div>
                     
                      
                    </div>

			<!-- Display photo, if any --> 

				<div class='control-group col-md-6'>
					<div class="controls ">
					<?php 
					if ($data['fileSize'] > 0) 
						echo '<img  height=5%; width=15%; src="data:image/jpeg;base64,' . 
							base64_encode( $data['content'] ) . '" />'; 
					else 
						echo 'No photo on file.';
					?><!-- converts to base 64 due to the need to read the binary files code and display img -->
					</div>
				</div>

                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
