<?php
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
		$q->execute(array($data['assign_artist_id']));
		$artistdata = $q->fetch(PDO::FETCH_ASSOC);

		# get patron details
		$sql = "SELECT * FROM patrons where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($data['assign_patron_id']));
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
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
