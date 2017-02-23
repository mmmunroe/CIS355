<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $descriptionError = null;
        $date_createdError = null;
        $priceError = null;
		$sizeError = null;
         
        // keep track post values
        $description = $_POST['description'];
        $date_created = $_POST['date_created'];
        $price = $_POST['price'];
		$size = $_POST['size'];
         
        // validate input
        $valid = true;
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
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
            $sql = "INSERT INTO artworks (description,date_created,price,size) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($description,$date_created,$price,$size));
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
             
                    <form class="form-horizontal" action="art_create.php" method="post">
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
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="artworks_page.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
