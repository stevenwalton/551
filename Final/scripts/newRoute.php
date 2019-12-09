<?php
#include_once 'src/routeFunctions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>New Routes</title>
    </head>
    <body>
    <br>
    Please enter the information for a new route
    <br>
    <form action="routeAdded.php", method="POST">
    Name:<input type="text" name="routeName"><br>

    Site:<input type="text" name="siteName"><br>

    Area:<input type="text" name="areaName"><br>

    Number of Pitches:<!--<input type="text" name="numPitches"><br>-->
    <select name="numPitches" id="npitch">
        <?php for($i = 0; $i <= 10; $i++) :?>
            <option value="<?php echo($i);?>"><?php echo($i);?></option>
        <?php endfor; ?>
    </select><br>

    Type: <br>sport<input type="radio" name="type" value="sport">
    trad<input type="radio" name="type" value="trad">
    top-rope<input type="radio" name="type" value="top-rope"><br>

    Approach: <input type="text" name="approach"><br>

    Description: <input type="text" name="description"><br>

    Likability (0-10): 
    <select name="likability" id="like">
        <?php for($i = 0; $i <= 10; $i++) :?>
            <option value="<?php echo($i);?>"><?php echo($i);?></option>
        <?php endfor; ?>
    </select><br>

    Difficulty: 5.
    <select name="diff_maj" id="maj">
        <?php for($i = 0; $i <= 15; $i++) :?>
            <option value="<?php echo($i);?>"><?php echo($i);?></option>
        <?php endfor; ?>
    </select>
    </select>
    <select name="diff_sub" id="sub">
        <option value="">--</option>
        <option value="0">a</option>
        <option value="0.25">b</option>
        <option value="0.5">c</option>
        <option value="0.75">d</option>
    </select><br>

    <input type="submit" value="submit">
    <br>
    </body>
    <footer><font size="1">
        This webpage is the final project for
        <a href="https://classes.cs.uoregon.edu/19F/cis451/">
        UO's CIS 551 (Database Processing)</a>.
        <br>
        Year: 2019
        <br>
        Work performed by: Steven Walton
        <br>
        This project was inspired by <a href="https://www.mountainproject.com/">
        Mountain Project</a>. Some photos may be taken from there. This project 
        is not intended for commercial use.
    </font>
    </footer>
</html>
