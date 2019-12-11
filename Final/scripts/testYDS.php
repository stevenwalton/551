<?php
include '../src/connect.php';
include '../src/basicFunctions.php';

$object = new Basic;

$a = 3;
$b = 'a';
$num = $object->difficultyToNumber($a,$b);
echo("input: ".$a." and ".$b." returning ".$num."<br>");
$rArray = $object->difficultyToYDS($num);
echo("Which returns back ".$rArray['major'].".".$rArray['minor']."<br>");

$a = 10;
$b = 'a';
$num = $object->difficultyToNumber($a,$b);
echo("input: ".$a." and ".$b." returning ".$num."<br>");
$rArray = $object->difficultyToYDS($num);
echo("Which returns back ".$rArray['major'].".".$rArray['minor']."<br>");

$a = 10;
$b = 'd';
$num = $object->difficultyToNumber($a,$b);
echo("input: ".$a." and ".$b." returning ".$num."<br>");
$rArray = $object->difficultyToYDS($num);
echo("Which returns back ".$rArray['major'].".".$rArray['minor']."<br>");

$a = 12;
$b = 'a';
$num = $object->difficultyToNumber($a,$b);
echo("input: ".$a." and ".$b." returning ".$num."<br>");
$rArray = $object->difficultyToYDS($num);
echo("Which returns back ".$rArray['major'].".".$rArray['minor']."<br>");

$a = 13;
$b = 'd';
$num = $object->difficultyToNumber($a,$b);
echo("input: ".$a." and ".$b." returning ".$num."<br>");
$rArray = $object->difficultyToYDS($num);
echo("Which returns back ".$rArray['major'].".".$rArray['minor']."<br>");

?>
