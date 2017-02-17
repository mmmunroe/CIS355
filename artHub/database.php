<?php
class Database
{
    private static $dbName = 'mmmunroe' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'mmmunroe';
    private static $dbUserPassword = 'dumb_password';

    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }

	public function displayArtContents()
	{
		$pdo = Database::connect();
		$sql = 'SELECT * FROM artworks ORDER BY id DESC';
		foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. $row['description'] . '</td>';
			echo '<td>'. $row['date_created'] . '</td>';
			echo '<td>'. $row['price'] . '</td>';
			echo '<td>'. $row['size'] . '</td>';
			echo '<td><a class="btn" href="favorite.php?id='.$row['id']. '">Favorite</a></td>';
			echo '</tr>';
		}
		Database::disconnect();
	}

	public displayArtHeading()
	{
		echo '<div class=container><div class=row><h3>Browse Art</h3></div>
		<div class=row><p><a class="btn btn-success"href=upload.php>Upload Art</a>
		<table class="table table-bordered table-striped"><thead><tr><th>Description
		<th>Date Created<th>Price<th>Size<th>Action<tbody>';
	}

	public function importBootstrap()
	{
		echo '<!DOCTYPE html>
			<html lang="en">
			<head>
    			<meta charset="utf-8">
    			<link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			</head>';
	}

	public function displayFooting()
	{
		echo '</tbody></table></div></div></body></html>';
	}

	public function displayArt()
	{
		Database::importBootstrap();
		Database::displayArtHeading();
		Database::displayArtContents();
		Database::displayFooting();
	}

	public function displayArtistCollection()
	{
		Database::importBootstrap();
		Database::displayArtistHeading();
		Database::displayArtistContents();
		Database::displayFooting();
	}

	public function displayPatronCollection()
	{
		Database::importBootstrap();
		Database::displayPatronHeading();
		Database::displayPatronContents();
		Database::displayFooting();
	}
}
?>

