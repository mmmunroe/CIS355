<?php
class Artists
{

	include 'database.php';
	
	public function displayArtistContents()
	{
		$pdo = Database::connect();
		$sql = 'SELECT * FROM artists ORDER BY id DESC';
		foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. $row['artist_name'] . '</td>';
			echo '<td>'. $row['email'] . '</td>';
			echo '<td>'. $row['experience'] . '</td>';
			echo '<td><a class="btn" href="favorite.php?id='.$row['id']. '">Favorite</a></td>';
			echo '</tr>';
		}
		Database::disconnect();
	}
	
	public displayArtistHeading()
	{
		echo '<div class=container><div class=row><h3>Browse Artists</h3></div>
		<div class=row><p><a class="btn btn-success"href=upload.php>Upload Art</a>
		<a class="btn btn-danger"href=logout.php>Log Out</a>
		<table class="table table-bordered table-striped"><thead><tr><th>Name
		<th>Email<th>Experience Level<th>Action<tbody>';
	}

	public function displayArtists()
	{
		Database::importBootstrap();
		Artists::displayArtistHeading();
		Artists::displayArtistContents();
		Database::displayFooting();
	}

}
?>