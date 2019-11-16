<?php
include_once 'asst4.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Assignment 4</title>
    </head>
    <!--Please enter a company name-->
    <body>
        <?php
              echo("Hello from php");
              ?>
        <?php
        $object = new Dbh;
        $object->connect();
        ?>
    </body>
    <!--
    <input type="text" name="company">
    <input type="submit" value="submit">
    -->

    <!--
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
    -->
</html>
