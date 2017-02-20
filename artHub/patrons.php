<?php
class Patrons
{
	include 'database.php';
	
	public function displayPatronContents()
	{
		$pdo = Database::connect();
		$sql = 'SELECT * FROM patrons ORDER BY id DESC';
		foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. $row['[patron_name'] . '</td>';
			echo '<td>'. $row['email'] . '</td>';
			echo '<td><a class="btn" href="favorite.php?id='.$row['id']. '">Favorite</a></td>';
			echo '</tr>';
		}
		Database::disconnect();
	}
	
	public displayPatronHeading()
	{
		echo '<div class=container><div class=row><h3>Browse Patrons</h3></div>
		<div class=row><p><a class="btn btn-success"href=upload.php>Upload Art</a>
		<a class="btn btn-danger"href=logout.php>Log Out</a>
		<table class="table table-bordered table-striped"><thead><tr><th>Name
		<th>Email<th>Action<tbody>';
	}

	public function displayPatrons()
	{
		Database::importBootstrap();
		Patrons::displayPatronHeading();
		Patrons::displayPatronContents();
		Database::displayFooting();
	}
}
?>