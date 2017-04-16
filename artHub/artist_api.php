<?php
/* ---------------------------------------------------------------------------
 * filename    : artist_api.php
 * description : Returns JSON object of all the names in the artists table OR 
 *               (if id param is set) only one person's name
 * ---------------------------------------------------------------------------
 */
	include 'database.php';
	
	$pdo = Database::connect();
	if($_GET['id']) 
		$sql = "SELECT * from artists WHERE id=" . $_GET['id']; 
	else
		$sql = "SELECT * from artists";
	$arr = array();
	foreach ($pdo->query($sql) as $row) {
	
		array_push($arr, $row['name']);
		
	}
	Database::disconnect();
	echo '{"names":' . json_encode($arr) . '}';
?>
