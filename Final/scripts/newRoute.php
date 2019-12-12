<?php
include_once '../src/connect.php';
include_once '../src/countryFunctions.php';
include_once '../src/stateFunctions.php';
include_once '../src/siteFunctions.php';
include_once '../src/areaFunctions.php';
include_once '../src/userFunctions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>New Routes</title>
    </head>
    <body>
    <a href="/~swalton2/551/Final">
    <img src="/~swalton2/551/Final/media/Title.png">
    </a>
    <br>
    Please enter the information for a new route
    <br>
    
    <form action="/~swalton2/551/Final/scripts/addRoute.php", method="POST">
    Route Name:<input type="text" name="routeName"><br>

    Country:
    <?php
    $_country = new Country;
    $countries = $_country->getAllCountries();
    ?>
    <select name="country">
        <option value="">--</option>
    <?php foreach ($countries as $country): ?>
        <option value="<?php echo($country);?>"> <?php echo($country);?></option>
    <?php endforeach; ?>
    </select>
    Add a new Country:
    <input type="text" name="new_country">
    
    <br> 

    State:
    <?php
    $_state = new State;
    $states = $_state->getAllStates();
    ?>
    <select name="state">
        <option value="">--</option>
    <?php foreach ($states as $state): ?>
        <option value="<?php echo($state);?>"> <?php echo($state);?></option>
    <?php endforeach; ?>
    </select>
    Add a new State:
    <input type="text" name="new_state">
    <br>
    Site:
    <?php
    $_site = new Site;
    $sites = $_site->getAllSites();
    ?>
    <select name="site">
        <option value="">--</option>
    <?php foreach ($sites as $site): ?>
        <option value="<?php echo($site);?>"> <?php echo($site);?></option>
    <?php endforeach; ?>
    </select>
    Add a new Site:
    <input type="text" name="new_site">
    <br>

    Area:
    <?php
    $_area = new Area;
    $areas = $_area->getAllAreas();
    ?>
    <select name="area">
        <option value="">--</option>
    <?php foreach ($areas as $area): ?>
        <option value="<?php echo($area);?>"> <?php echo($area);?></option>
    <?php endforeach; ?>
    </select>
    Add a new Area:
    <input type="text" name="new_area">
    <br>

    Number of Pitches:<!--<input type="text" name="numPitches"><br>-->
<!--
TODO: 10+ pitches
-->
    <select name="numPitches" id="npitch">
        <?php for($i = 1; $i <= 10; $i++) :?>
            <option value="<?php echo($i);?>"><?php echo($i);?></option>
        <?php endfor; ?>
    <!--
            <option value="10">10+</option>
-->
    </select><br>

    Type: <br>sport<input type="radio" name="type" value="sport">
    trad<input type="radio" name="type" value="trad" checked>
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
    Picture URL: <input type="text" name="picture">
    User :<!--<input type="text" name="username">-->
    <?php
    $_user = new User;
    $usernames = $_user->getAllUserNames();
    ?>
    <select name="username" id="username">
        <option value="">--</option>
    <?php foreach($usernames as $user): ?>
        <option value="<?php echo($user);?>"><?php echo($user); ?> </option>
    <?php endforeach; ?>

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
