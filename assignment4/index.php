<?php
include_once 'connect.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Assignment 4</title>
    </head>
    <body>
    Please select a company
    <?php
    $object = new Dbh;
    $object->connect();
    ?>
    <br>
    <input type="text" name="state"> 
    <input type="submit" value="submit">
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
