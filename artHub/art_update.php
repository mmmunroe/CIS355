<?php
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
         
        // keep track post values
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date_created = $_POST['date_created'];
        $price = $_POST['price'];
		$size = $_POST['size'];
         
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
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE artworks  set title = ?, description = ?, date_created = ?, price =?, size = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($title,$description,$date_created,$price,$size,$id));
            Database::disconnect();
            header("Location: artworks_page.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM artworks where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
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
             
                    <form class="form-horizontal" action="art_update.php?id=<?php echo $id?>" method="post">
                    
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
                            <input name="date_created" type="text" placeholder="Date Created" value="<?php echo !empty($date_created)?$date_created:'';?>">
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
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="artworks_page.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
