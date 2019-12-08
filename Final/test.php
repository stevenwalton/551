<?php
include_once 'src/connect.php';
include_once 'src/basicFunctions.php';
include_once 'src/countryFunctions.php';
include_once 'src/stateFunctions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Results From Query</title>
    </head>
    <body>
    
    <?php
    $name= $_POST['name'];
    #$object = new State;
    #$object->setCountry($name);
    #$object->addState($name,"Test");
    $object = new Country;
    $name = $object->getCountryName($name);
    echo($name);
    ?>
    </body>
    <footer><font size="1">
        This webpage is for 
        <a href="https://classes.cs.uoregon.edu/19F/cis451/assts/asst4/asst4.html">
        Assignment 4</a> from UO's CIS 551 (Database Processing).
        <br>
        Year: 2019
        <br>
        Work performed by: Steven Walton
    </font>
    </footer>
</html>
