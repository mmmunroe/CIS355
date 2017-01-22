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
?>