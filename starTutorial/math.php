<?php
		
	$a = $_POST['a'];
	$b = $_POST['b'];
	$c = $_POST['c'];
	$d = $_POST['d'];
	
			$Q1 = (2 * $b ** 3 - 9 * $a * $b * $c + 27 * $a ** 2 * $d) ** 2;
			$Q2 = (4 * ($b ** 2 - 3 * $a * $c)) ** 3;
			$Q = (pow($Q1 - $Q2, 0.5));
			echo 'Q = ' . $Q . '<br/>';
					
			$C = pow(($Q + 2 * pow($b, 3) - 9 * $a * $b * $c + 27 * pow($a, 2) * $d) / 2, 1 / 3);
			echo 'C = ' . $C . '<br/>';
			
			$x = 0 - (($b) / (3 * $a)) - (($C) / (3 * $a)) - ((pow(b, 2) - 3 * $a * $c) / (3 * $a * $C));
	
	echo "The answer is: ".$x;
	
	echo "</br>";
	
	show_source(__FILE__);
?>