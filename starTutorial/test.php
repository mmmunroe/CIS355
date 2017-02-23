Zippy dee <br/>

<?php
	echo "<strong>hello world <br/> how's it going world?</strong>";
	
	$a = 1;
	$b = 1.5;
	$c = "hello";
	$d = true;
	$e = array(1, 2, 3, 4, 5);
	// $f = {hello: "hi", world: "globe"};
	$g = null;
	
	echo "<br />a + b equals " . ($a + $b);
	
	echo "<br/>".$c[0];
	
	$digits = "1111111";
	$sum = 0;
	
	for ($i=0; $i<strlen($digits); $i++) {
		$sum += $digits[$i];
	}
	
	echo "<br/>The sum of digits is: ".$sum;
	
	//$Q = 0;
	//$C = 0;
	//$x = 0;
	
	//$Q = sqrt(pow(2* pow($b, 3) - 9 * $a * $b * $c + 27 * pow($a, 2) * $d , 2)
	//- 4 * pow((pow($b,2) - 3 * $a * $c ), 3));
	
	//$C = pow(1/2 * ($Q + 2* pow($b, 3) - 9 * $a * $b * $c + 27 * pow($a, 2) * $d) ,1/3);
	
	//$x = -(b / 3 * $a) - (C / 3 * $a) - (pow($b, 2) - 3 * $a * $c / 3 * $a * $C);
?>