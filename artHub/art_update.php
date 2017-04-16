<?php
	/* ---------------------------------------------------------------------------
	* filename    : art_update.php
	* description : allows user to update an artwork description.
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
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
		$titleError = null;
        $descriptionError = null;
        $date_createdError = null;
        $priceError = null;
		$sizeError = null;
		$pictureError = null;

		$artist_idError = null;
		$patron_idError = null;
         
        // keep track post values
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date_created = $_POST['date_created'];
        $price = $_POST['price'];
		$size = $_POST['size'];
		$picture = $_POST['picture'];
        
		$artist_id = $_POST['artist_id'];
		$patron_id = $_POST['patron_id'];

		// initialize $_FILES variables
		$fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];
		$content = file_get_contents($tmpName);
 
        // validate input
        $valid = true;

		if (empty($title)) {
            $titleError = 'Please enter a title';
            $valid = false;
		}

        if (empty($description)) {
            $descriptionError = 'Please enter a description';
            $valid = false;
        }
         
        if (empty($date_created)) {
            $date_createdError = 'Please enter a date';
            $valid = false;
        } 
         
        if (empty($price)) {
            $priceError = 'Please enter a price';
            $valid = false;
        }

		if (empty($artist_id)) {
			$artist_idError = 'Please choose an artist';
			$valid = false;
		}
		if (empty($patron_id)) {
			$patron_idError = 'Please choose a patron';
			$valid = false;
		} 

		// restrict file types for upload
		$types = array('image/jpeg','image/gif','image/png');
		if($filesize > 0) {
			if(in_array($_FILES['userfile']['type'], $types)) {
			}
			else {
				$filename = null;
				$filetype = null;
				$filesize = null;
				$filecontent = null;
				$pictureError = 'improper file type';
				$valid=false;
			
			}
		}
         
        if ($valid) { // if valid user input update the database
	
		if($fileSize > 0) { // if file was updated, update all fields
			$pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE artworks  set artist_id = ?, patron_id = ?, title = ?, description = ?, date_created = ?, price =?, size = ?, fileName = ?, fileSize = ?, fileType = ?, content = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($artist_id,$patron_id,$title,$description,$date_created,$price,$size,$fileName,$fileSize,$fileType,$content,$id));
            Database::disconnect();
            header("Location: artworks_page.php");
		}
		else { // otherwise, update all fields EXCEPT file fields
			$pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE artworks  set artist_id = ?, patron_id = ?, title = ?, description = ?, date_created = ?, price =?, size = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($artist_id,$patron_id,$title,$description,$date_created,$price,$size,$id));
            Database::disconnect();
            header("Location: artworks_page.php");
		}
	}
 } else { // if $_POST NOT filled then pre-populate the form
	$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM artworks where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $artist_id = $data['artist_id'];
        $patron_id = $data['patron_id'];
        $title = $data['title'];
        $description = $data['description'];
        $date_created = $data['date_created'];
        $price = $data['price'];
        $size = $data['size'];
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
                        <h3>Update an Artwork</h3>
                    </div>
             
                    <form class="form-horizontal" action="art_update.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
                    
					<div class="control-group">
					<label class="control-label">Artist</label>
					<div class="controls">
						<?php
							$pdo = Database::connect();
							$sql = 'SELECT * FROM artists ORDER BY name ASC';
							echo "<select class='form-control' name='artist_id' id='artist_id'>";
							foreach ($pdo->query($sql) as $row) {
								if($row['id']==$artist)
									echo "<option selected value='" . $row['id'] . " '> " . $row['name'] . "</option>";
								else
									echo "<option value='" . $row['id'] . " '> " . $row['name'] . "</option>";
							}
							echo "</select>";
							Database::disconnect();
						?>
					</div>	<!-- end div: class="controls" -->
				</div> <!-- end div class="control-group" -->

					<div class="control-group">
					<label class="control-label">Patron</label>
					<div class="controls">
						<?php
							$pdo = Database::connect();
							$sql = 'SELECT * FROM patrons ORDER BY name ASC';
							echo "<select class='form-control' name='patron_id' id='patron_id'>";
							foreach ($pdo->query($sql) as $row) {
								if($row['id']==$patron) {
									echo "<option selected value='" . $row['id'] . " '> " . $row['name'] . "</option>";
								}
								else {
									echo "<option selected value='" . $row['id'] . " '> " . $row['name'] . "</option>";
								}
							}
							echo "</select>";
							Database::disconnect();
						?>
					</div>	<!-- end div: class="controls" -->
				</div> <!-- end div class="control-group" -->

					<div class="control-group <?php echo !empty($titleError)?'error':'';?>">
                        <label class="control-label">Title</label>
                        <div class="controls">
                            <input name="title" type="text"  placeholder="Title" value="<?php echo !empty($title)?$title:'';?>">
                            <?php if (!empty($titleError)): ?>
                                <span class="help-inline"><?php echo $titleError;?></span>
                            <?php endif; ?>
						</div>
             		</div>
  
					<div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input name="description" type="text"  placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($date_createdError)?'error':'';?>">
                        <label class="control-label">Date Created</label>
                        <div class="controls">
                            <input name="date_created" type="text" placeholder="YYYY-MM-DD" value="<?php echo !empty($date_created)?$date_created:'';?>">
                            <?php if (!empty($date_createdError)): ?>
                                <span class="help-inline"><?php echo $date_createdError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <input name="price" type="text"  placeholder="Price" value="<?php echo !empty($price)?$price:'';?>">
                            <?php if (!empty($priceError)): ?>
                                <span class="help-inline"><?php echo $priceError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($sizeError)?'error':'';?>">
                        <label class="control-label">Size</label>
                        <div class="controls">
                            <input name="size" type="text"  placeholder="Size" value="<?php echo !empty($size)?$size:'';?>">
                            <?php if (!empty($sizeError)): ?>
                                <span class="help-inline"><?php echo $sizeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					<div class="control-group <?php echo !empty($pictureError)?'error':'';?>">
					<label class="control-label">Picture</label>
					<div class="controls">
						<input type="hidden" name="MAX_FILE_SIZE" value="16000000">
						<input name="userfile" type="file" id="userfile">
					</div>
				</div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="artworks_page.php">Back</a>
                        </div>
                    </form>

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
