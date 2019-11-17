<?php
include_once 'connect.php';
include_once 'databases.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Results From Query</title>
    </head>
    <body>
    
    <?php
    $manu = $_POST['manu'];
    echo("Querying customers for: ".$manu);
    echo("<br>");
    echo("<br>");
    $object = new Databases;
    $object->getCustomers($manu);
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
