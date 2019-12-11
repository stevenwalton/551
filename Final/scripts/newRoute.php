<?php
include_once '../src/connect.php';
include_once '../src/countryFunctions.php';
include_once '../src/stateFunctions.php';
include_once '../src/siteFunctions.php';
include_once '../src/areaFunctions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>New Routes</title>
    </head>
    <body>
    <a href="/Final">
    <img src="/Final/media/Title.png">
    </a>
    <br>
    Please enter the information for a new route
    <br>
    
    <form action="/Final/scripts/addRoute.php", method="POST">
    Route Name:<input type="text" name="routeName"><br>

    Country:
    <?php
    $_country = new Country;
    $countries = $_country->getAllCountries();
    ?>
    <select name="country">
    <?php foreach ($countries as $country): ?>
        <option value="<?php echo($country);?>"> <?php echo($country);?></option>
    <?php endforeach; ?>
    </select>
    
    <br> 

    State:
    <?php
    $_state = new State;
    $states = $_state->getAllStates();
    ?>
    <select name="state">
    <?php foreach ($states as $state): ?>
        <option value="<?php echo($state);?>"> <?php echo($state);?></option>
    <?php endforeach; ?>
    </select>
    <br>


    Site:
    <?php
    $_site = new Site;
    $sites = $_site->getAllSites();
    ?>
    <select name="site">
    <?php foreach ($sites as $site): ?>
        <option value="<?php echo($site);?>"> <?php echo($site);?></option>
    <?php endforeach; ?>
    </select>
    <br>

    Area:
    <?php
    $_area = new Area;
    $areas = $_area->getAllAreas();
    ?>
    <select name="area">
    <?php foreach ($areas as $area): ?>
        <option value="<?php echo($area);?>"> <?php echo($area);?></option>
    <?php endforeach; ?>
    </select>
    <br>

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
    <select name="diff_min" id="sub">
        <option value="">--</option>
        <option value="a">a</option>
        <option value="b">b</option>
        <option value="c">c</option>
        <option value="d">d</option>
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
