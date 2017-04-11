<?php

    require 'database.php';

    if ( !empty($_POST)) {
        // keep track validation errors
		$artist_idError = null;
		$patron_idError = null;
        $titleError = null;
        $descriptionError = null;
        $date_createdError = null;
        $priceError = null;
        $sizeError = null;
		$pictureError = null;

        // keep track post values
		$artist_id = $_POST['artist_id'];
		$patron_id = $_POST['patron_id'];
		$title = $_POST['title'];
        $description = $_POST['description'];
        $date_created = $_POST['date_created'];
        $price = $_POST['price'];
        $size = $_POST['size'];
		$picture = $_POST['picture'];

		// initialize $_FILES variables
		$fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];
		$content = file_get_contents($tmpName);

        // validate input
        $valid = true;
		if (empty($artist_id)) {
            $artist_id = 'Please enter an artist';
            $valid = false;
        }
		
		if (empty($patron_id)) {
            $patron_idError = 'Please enter a patron';
            $valid = false;
        }
		
		if (empty($title)) {
			$titleError = 'Please enter a title';
			$valid = false;
		}

        if (empty($description)) {
            $nameError = 'Please enter a description';
            $valid = false;
        }

        if (empty($date_created)) {
            $emailError = 'Please enter a date';
            $valid = false;
        }

        if (empty($price)) {
            $priceError = 'Please enter a price';
            $valid = false;
        }

        if (empty($size)) {
            $sizeError = 'Please enter a size';
            $valid = false;
        }

		// restrict file types for upload
		$types = array('image/jpeg','image/gif','image/png');
		if($filesize > 0) {
			if(in_array($_FILES['userfile']['type'], $types)) {
			}
			else {
				$fileName = null;
				$fileType = null;
				$fileSize = null;
				$fileContent = null;
				$pictureError = 'improper file type';
				$valid=false;
			
			}
		}

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO artworks (artist_id,patron_id,title,description,date_created,price,size,fileName,fileSize,fileType,content) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($artist_id,$patron_id,$title,$description,$date_created,$price,$size,$fileName,$fileSize,$fileType,$content));
            Database::disconnect();
            header("Location: artworks_page.php");
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

                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create an Artwork</h3>
                    </div>

                    <form class="form-horizontal" action="art_create.php" method="post" enctype="multipart/form-data">

                      <div class="control-group <?php echo !empty($artist_idError)?'error':'';?>">
                        <label class="control-label">Artist</label>
                        <div class="controls">
                            <select name="artist_id" type="text"  placeholder="Artist Id" value="<?php echo !empty($artist_id)?$artist_id:'';?>">
                            <?php
								$pdo = Database::connect();
								$sql = 'SELECT * FROM artists ORDER BY id DESC';
								foreach ($pdo->query($sql) as $row) {
									echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
								}
								Database::disconnect();
							?>
							<?php if (!empty($artist_idError)): ?>
                                <span class="help-inline"><?php echo $artist_idError;?></span>
                            <?php endif; ?>
							</select>
                        </div>
                      </div>

					  <div class="control-group <?php echo !empty($patron_idError)?'error':'';?>">
                        <label class="control-label">Patron</label>
                        <div class="controls">
							<select name="patron_id"  placeholder="Patron Id" value="<?php echo !empty($patron_id)?$patron_id:'';?>">
                            <?php
								$pdo = Database::connect();
								$sql = 'SELECT * FROM patrons ORDER BY id DESC';
								foreach ($pdo->query($sql) as $row) {
									echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
								}
								Database::disconnect();
							?>
                            <?php if (!empty($patron_id)): ?>
                                <span class="help-inline"><?php echo $patron_idError;?></span>
                            <?php endif; ?>
							</select>
                        </div>
                      </div>

					  <div class="control-group <?php echo !empty($titleError)?'error':'';?>">
                        <label class="control-label">Title</label>
                        <div class="controls">
                            <input name="title" type="text"  placeholder="Title" value="<?php echo !empty($title)?$title:'';?>">
                            <?php if (!empty($titleError)): ?>
                                <span class="help-inline"><?php echo $titleError;?></span>
                            <?php endif;?>
                        </div>
                      </div>


					  <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input name="description" type="text"  placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif;?>
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
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="artworks_page.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>

