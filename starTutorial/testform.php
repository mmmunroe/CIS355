<?php
	$digits = $_GET['number'];
	$sum = 0;
	
	for ($i=0; $i<strlen($digits); $i++) {
		$sum += $digits[$i];
	}
	
	echo "<br/>The sum of digits is: ".$sum;
?>