<?php
class Artworks
{
	include 'database.php';

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
		<a class="btn btn-danger"href=logout.php>Log Out</a>
		<table class="table table-bordered table-striped"><thead><tr><th>Description
		<th>Date Created<th>Price<th>Size<th>Action<tbody>';
	}

	public function displayArt()
	{
		Database::importBootstrap();
		Artworks::displayArtHeading();
		Artworks::displayArtContents();
		Database::displayFooting();
	}
}
?>