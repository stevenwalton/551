<?php
include_once 'src/connect.php';
include_once 'src/basicFunctions.php';
include_once 'src/countryFunctions.php';
include_once 'src/stateFunctions.php';
include_once 'src/siteFunctions.php';
include_once 'src/areaFunctions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Climbing Project</title>
    </head>
    <body>
    <a href="/Final">
    <img src="./media/Title.png">
    </a>
    <br>
    Welcome to Climbing Project. Here you may explore and search for different 
    climbing routes. Remember to climb safe!
    <br>
    Available Countries
    <br>
    <?php
    $object = new Country;
    $countries = $object->getAllCountries();
    ?>
    <?php foreach ($countries as $c): ?>
        <a href="/Final/Countries/<?php echo($c); ?>.php"> <?php echo($c) ?></a>
    <?php endforeach; ?>
    <br>
    Add a country
    <form action="scripts/addCountry.php" method="POST">
    <input type="text" name="name">
    <input type="submit" value="submit">
    </form>
    <br>
    Add a state 
    <form action="scripts/addState.php" method="POST">
    <select name="country">
        <?php foreach($countries as $c): ?>
            <option value="<?php echo($c);?>"><?php echo($c);?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="stateName">
    <input type="submit" value="submit">
    </form>
    <br>
    Add a site
    <br>
    <?php
    $s = new State;
    $states = $s->getAllStates();
    ?>
    <form action="scripts/addSite.php" method="POST">
    <select name="state">
        <?php foreach($states as $state): ?>
            <option value="<?php echo($state);?>"><?php echo($state);?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="siteName">
    <input type="submit" value="submit">
    </form>
    <br>
    Add an area 
    <br>
    <?php
    $si = new Site;
    $sites= $si->getAllSites();
    ?>
    <form action="scripts/addArea.php" method="POST">
    <select name="site">
        <?php foreach($sites as $site): ?>
            <option value="<?php echo($site);?>"><?php echo($site);?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="name">
    <input type="submit" value="submit">
    </form>
    <br>
    Help expand our list! If you would like to add a route 
    <a href="scripts/newRoute.php">click here!</a>
    </body>
    <?php include 'footer.php';?>
</html>
