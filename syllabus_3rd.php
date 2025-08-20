<?php
$a = 10;
$b = 5;

echo " <h2> there are two variables A = 10 and B = 5 </h2> <br> <br> ";

echo "Arithmetic Operators:<br>";
echo " Plus: a + b = " . ($a + $b) . "<br>";
echo " Minus: a - b = " . ($a - $b) . "<br>";
echo " Multiply: a * b = " . ($a * $b) . "<br>";
echo " Division: a / b = " . ($a / $b) . "<br>";
echo " Modulus: a % b = " . ($a % $b) . "<br><br>";

echo "Comparison Operators:<br>";

echo " equal: " . (($a == $b) ? 'true' : 'false') . "<br>";
echo " not equal: " . (($a != $b) ? 'true' : 'false') . "<br>";
echo " greater than: " . (($a > $b) ? 'true' : 'false') . "<br>";
echo " less than: " . (($a < $b) ? 'true' : 'false') . "<br>";
echo " greater than or equal to: " . (($a >= $b) ? 'true' : 'false') . "<br>";
echo " less than or equal to: " . (($a <= $b) ? 'true' : 'false') . "<br><br>";

echo "Logical Operators:<br>";

$x = true;
$y = false;

echo " and (x && y): " . (($x && $y) ? 'true' : 'false') . "<br>";
echo " or (x || y): " . (($x || $y) ? 'true' : 'false') . "<br>";
echo " not (!x): " . ((!$x) ? 'true' : 'false') . "<br>";
?>
