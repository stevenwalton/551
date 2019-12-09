<?php
include_once 'src/connect.php';
include_once 'src/basicFunctions.php';
include_once 'src/countryFunctions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Climbing Project</title>
    </head>
    <body>
    <img src="./media/Title.png">
    <br>
    Welcome to Climbing Project. Here you may explore and search for different 
    climbing routes. Remember to climb safe!
    <br>
    Available Countries
    <br>
    <?php
    $object = new Country;
    #$object->listCountries();
    $countries = $object->getCountries();
    ?>
    <?php foreach ($countries as $c): ?>
        <a href="/Countries/<?php echo($c); ?>.php"> <?php echo($c) ?></a>
    <?php endforeach; ?>
    <!--
    <form action="USA/index.php" method="POST">
    <input type="text" name="manu"> 
    <input type="submit" value="submit">
    -->
    <br>
    Add a country
    <form action="scripts/addCountry.php" method="POST">
    <input type="text" name="name">
    <input type="submit" value="submit">
    </form>
    <br>
    Help expand our list! If you would like to add a route 
    <a href="scripts/newRoute.php">click here!</a>
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
