<?php
	/* ---------------------------------------------------------------------------
	* filename    : login.php
	* description : allows user to log in.
	* ---------------------------------------------------------------------------
	*/

        session_start();
		
		require 'database.php';
		
		if ( !empty($_POST)) {

			$name = $_POST['name'];
			$password = $_POST['password'];
			$passwordhash = MD5($password);

			//find record
        
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM artists WHERE name = ? AND password = ? LIMIT 1";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$passwordhash));
			$data = $q->fetch(PDO::FETCH_ASSOC);
	
			if($data) { // if successful artist login set session variables
				$_SESSION['artist_id'] = $data['id'];
				$sessionid = $data['id'];
				Database::disconnect();
				header("Location: artHub.php?id=$sessionid ");
			}

			else { // check if user is a patron
				$sql = "SELECT * FROM patrons WHERE name = ? AND password = ? LIMIT 1";
				$q = $pdo->prepare($sql);
				$q->execute(array($name,$passwordhash));
				$data = $q->fetch(PDO::FETCH_ASSOC);
	
				if($data) { // if successful patron login set session variables
					$_SESSION['patron_id'] = $data['id'];
					$sessionid = $data['id'];
					Database::disconnect();
					header("Location: artHub.php?id=$sessionid ");
				}
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

                
        <div class="row">
                <h3>Welcome</h3>

		<br /> <br />

                
        <form method="post" action="login.php">
                <table>
        <tr>
           <td>Name : </td>
           <td><input type="text" name="name" class="textInput"></td>
        </tr> 
        <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
        </tr> 
        <tr>
           <td></td>
           <td><input type="submit" name="login_btn" class="Log In"></td>
        </tr>
                </table>

				<br /> <br />
                <p>
                <a href="artist_create.php" class="btn btn-primary">Create new Artist Account</a>
        </p>
                <p>
                        <a href="patron_create.php" class="btn btn-info">Create new Patron Account</a>
                </p>
        </div> <!-- /row -->
    </div> <!-- /container -->
  </body>
</html>
