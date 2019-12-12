<?php
include_once 'src/connect.php';
include_once 'src/basicFunctions.php';
include_once 'src/countryFunctions.php';
include_once 'src/stateFunctions.php';
include_once 'src/siteFunctions.php';
include_once 'src/areaFunctions.php';
include_once 'src/routeFunctions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Climbing Project</title>
    </head>
    <body>
    <a href="/~swalton2/551/Final">
    <img src="/~swalton2/551/Final/media/Title.png">
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
        <a href="/~swalton2/551/Final/Countries/<?php echo($c); ?>"> <?php echo($c) ?></a>
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
    Country:<input type="text" name="country">
<!--
    <select name="country">
        <?php foreach($countries as $c): ?>
            <option value="<?php echo($c);?>"><?php echo($c);?></option>
        <?php endforeach; ?>
    </select>
-->
    State:<input type="text" name="stateName">
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
    Country:<input type="text" name="country">
    State:<input type="text" name="state">
<!--
    <select name="state">
        <?php foreach($states as $state): ?>
            <option value="<?php echo($state);?>"><?php echo($state);?></option>
        <?php endforeach; ?>
    </select>
-->
    Site:<input type="text" name="siteName">
    <input type="submit" value="submit">
    </form>
    <br>
    Add an area 
    <br>
    <?php
    #$si = new Site;
    #$sites= $si->getAllSites();
    ?>
    <form action="scripts/addArea.php" method="POST">
    Country:<input type="text" name="country">
    State: <input type="text" name="state">
    Site: <input type="text" name="site">
<!--
    <select name="site">
        <?php foreach($sites as $site): ?>
            <option value="<?php echo($site);?>"><?php echo($site);?></option>
        <?php endforeach; ?>
    </select>
-->
    <input type="text" name="name">
    <input type="submit" value="submit">
    </form>
    <br>
    Search routes (don't need all parameters):
    <form action="/~swalton2/551/Final/scripts/routeInfo.php", method="POST">
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
    Likability:
    <select name="like" id="like">
            <option value="">--</option>
        <?php for($i = 0; $i <= 10; $i++) :?>
            <option value="<?php echo($i);?>"><?php echo($i);?></option>
        <?php endfor; ?>
    </select>
    Difficulty: 5.
    <select name="diff_maj" id="maj">
            <option value="">--</option>
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
    </select>
    Type:
    <select name="type", id="type">
        <option value="">--</option>
        <option value="sport">sport</option>
        <option value="trad">trad</option>
        <option value="top-rope">top-rope</option>
    </select>
    Number of Pitches:
    <select name="nPitch", id="nPitch">
            <option value="">--</option>
        <?php for($i = 0; $i <= 9; $i++) :?>
            <option value="<?php echo($i);?>"><?php echo($i);?></option>
        <?php endfor; ?>
            <option value="10">10+</option>
    </select>
    <input type="submit" value="search">
    <br>
    New User? Add Yourself <a href="scripts/newUser.php">here</a>
    <br>
    Or Find Other Users <a href="scripts/allUsers.php">here</a>
    <br>
    <?php
    #$_route = new Route;
    #$sql = "SELECT name FROM routes LEFT JOIN area a LEFT JOIN site si LEFT JOIN state s WHERE s.idState = 0;";
    #$stmt = $_route->connect()->query($sql);
    #while($row = $stmt->fetch())
    #{
    #    $name = $row['name'];
    #    echo($name."<br>");
    #} 
    ?>
    <br>
    See all routes <a href='scripts/routeList.php'>here</a>, sorted by popularity.
    <br>
    Help expand our list! If you would like to add a route 
    <a href="scripts/newRoute.php">click here!</a>
    </body>
    <?php include 'footer.php';?>
</html>
