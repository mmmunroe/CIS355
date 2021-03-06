<?php
	/* ---------------------------------------------------------------------------
	* filename    : artist_create.php
	* description : allows user to create an artist account.
	* ---------------------------------------------------------------------------
	*/

    require 'database.php';

    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $passwordError = null;
		$experienceError = null;
		
        // keep track post values
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
		$experience = $_POST['experience'];

        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter a name';
            $valid = false;
        }

        if (empty($email)) {
            $emailError = 'Please enter an email address';
            $valid = false;
        }

        if (empty($password)) {
            $passwordError = 'Please enter a password';
            $valid = false;
        } else
			$password = md5($password);

		
		if (empty($experience)) {
            $experienceError = 'Please enter an experience level';
            $valid = false;
        }

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO artists (name,email,password,experience) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$password,$experience));
            Database::disconnect();
            header("Location: artists_page.php");
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
                        <h3>Create an Artist</h3>
                    </div>

                    <form class="form-horizontal" action="artist_create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input name="password" type="password"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
                            <?php if (!empty($passwordError)): ?>
                                <span class="help-inline"><?php echo $passwordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($experienceError)?'error':'';?>">
                        <label class="control-label">Experience</label>
                        <div class="controls">
                            <input name="experience" type="text"  placeholder="Experience" value="<?php echo !empty($experience)?$experience:'';?>">
                            <?php if (!empty($experienceError)): ?>
                                <span class="help-inline"><?php echo $experienceError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="artists_page.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>

