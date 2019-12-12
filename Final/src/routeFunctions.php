<?php
include_once "basicFunctions.php";
include_once "stateFunctions.php";
include_once "siteFunctions.php";
include_once "areaFunctions.php";

class Route extends Dbh
{
    public function listRoutes()
    {
        $stmt = $this->connect()->query("SELECT * FROM routes;");
        while($row = $stmt->fetch())
        {
            $name = $row['name'];
            echo($name);
            echo("<br>");
        }
    }

    public function getRoutesInArea($site)
    {
        $sql = "SELECT route.name FROM route 
                JOIN area USING(idSite)
                WHERE area.name = ".$site.";";
        $stmt = $this->connect()->query($sql);
        $routes = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $routes;
    }

    public function getRoutesInSiteNamed($site, $state, $country)
    {
        /*
        $sql = "SELECT route.name FROM route 
                JOIN site USING(idSite)
                WHERE site.name = ".$site.";";
         */
        $_site = new site;
        $idSite = $_site->getSiteID($site, $state, $country);
        $routes = $this->getRoutesInSiteID($idSite);
        return $routes;
    }

    public function getRoutesInSiteID($idSite)
    {
        // TODO
    }

    public function getRoutesInState($state)
    {
        $sql = "SELECT route.name FROM route 
                JOIN site USING(idSite)
                JOIN state USING(idState)
                WHERE state.name = ".$state.";";
        $stmt = $this->connect()->query($sql);
        $routes = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $routes;
    }

    public function getRoutesInCountry($country)
    {
        $sql = "SELECT route.name FROM route 
                JOIN site USING(idSite)
                JOIN state USING(idState)
                JOIN country USING(idCountry)
                WHERE country.name = ".$country.";";
        $stmt = $this->connect()->query($sql);
        $routes = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $routes;
    }

    public function getAllRoutes()
    {
        $sql = "SELECT name FROM route;";
        $stmt = $this->connect()->query($sql);
        $routes = $stmt->fetchAll();
        return $routes;
    }

    public function getRoutesByArea($areaID)
    {
        $sql = "SELECT name FROM route WHERE idArea = ".$areaID.";";
        $stmt = $this->connect()->query($sql);
        $routes = $stmt->fetchAll();
        return $routes;
    }

    public function getRoutesBySite($siteID)
    {
        $sql = "SELECT name FROM route WHERE idSite = ".$siteID.";";
        $stmt = $this->connect()->query($sql);
        $routes = $stmt->fetchAll();
        return $routes;
    }

    public function updateLikability($vote, $id)
    {
        // force constraints (0-10)
        if ($vote > 10)
        {
            $vote = 10;
        }
        elseif ($vote < 0)
        {
            $vote = 0;
        }
        if ($id < 0 or $id == NULL) // Error check invalid route ID
        {
            return 1;
        }
        // Get current likability and number of votes
        $stmt = $this->connect()->query("SELECT likability, likeVotes FROM route
                                         WHERE idRoute = ".$id.";");
        // TODO: if more than one row returned
        $row = $stmt->fetch();
        $N = $row['likeVotes'];
        $like = $row['likability'];

        $newLike = (($like * $N) + $vote) / ($N + 1);
        $N++;
        // Update vote and number of likes (+1)
        $sql = "UPDATE route SET likability=".$newLike.", likeVotes=".$N."
                WHERE idRoute = ".$id.";";
        try
        {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return 0;
        }
        catch(PDOException $e)
        {
            echo($sql . "<br>" . $e->getMessage());
            return 1;
        }
    }

    public function updateDifficulty($vote, $id)
    {
        // Force constraints
        if ($vote < 0)
        {
            $vote = 0;
        }
        if ($id < 0 or $id == NULL)
        {
            return 1;
        }
        // Get current difficulty and number of votes
        $sql = "SELECT difficulty, diffVotes FROM route WHERE idRoute = ".$id.";";
        $stmt = $this->connect()->query($sql);
        // TODO: Nothing returned or more than one
        $row = $stmt->fetch();
        $diff = $row['difficulty'];
        $N = $row['diffVotes'];
        $newDiff = (($diff * $N) + $vote) / ($N + 1);
        $N++;
        // Update vote 
        $sql = "UPDATE route SET difficulty=".$newDiff.", diffVotes=".$N."
                WHERE idRoute = ".$id.";";
        try
        {
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return 0;
        }
        catch(PDOException $e)
        {
            echo($sql."<br>".$e->getMessage());
            return 1;
        }

    }

    public function addRoute($name, 
                             $country,
                             $state,
                             $site=NULL,
                             $area=NULL,
                             $numPitches=1, 
                             $type=NULL,
                             $approach=NULL, 
                             $description=NULL,
                             $likability=0,
                             $difficulty=0.0)
    {
        echo("In addRoute<br>");
        $id = 0;
        // Check site/Area
        if ($site == NULL and $area == NULL)
        {
            echo("ERROR: At minimum need a site or area<br>");
            return 1;
        }
        elseif ($area == NULL)
        {
            $_site = new Site;
            $idSite = $_site->getSiteID($site, $state, $country);
            $_area = new Area;
            $idArea = $_area->getAreaID($area, $site, $state, $country);
        }
        else // site can be null because we'll get a new one
        {
            $_area = new Area;
            $idArea = $_area->getAreaID($area, $site, $state, $country);
            $_site = new Site;
            $idSite = $_site->getSiteID($site, $state, $country);
        }
        echo("Have country: ".$country." in state: ".$state." at site: ".$site."
              in area ".$area." with route name: ".$name."<br>");
        $stmt = $this->connect()->query("SELECT * FROM route;");
        var_dump($stmt);
        if(!(in_array($name,$stmt->fetch(),true)))
        {
            $stmt = $this->connect()->query("SELECT count(idRoute) c FROM route;");
            $id = $stmt->fetch()['c'];
            echo("New method to grab id gives: ".$id."<br>");

            $sql = "INSERT INTO route (idRoute,
                                       type,
                                       numPitches,
                                       approach,
                                       description,
                                       name,
                                       idSite,
                                       idArea,
                                       difficulty,
                                       likability,
                                       likeVotes,
                                       diffVotes)
                                       VALUES ('".$id."',
                                               '".$type."',
                                               '".$numPitches."',
                                               '".$approach."',
                                               '".$description."',
                                               '".$name."',
                                               '".$idSite."',
                                               '".$idArea."',
                                               '".$difficulty."',
                                               '".$likability."',
                                               '0','0');";
            echo("Inserting: <br>".$sql."<br>");
            try
            {
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
                return 0;
            }
            catch(PDOException $e)
            {
                echo($sql."<br>".$e->getMessage());
                return 1;
            }
            return 0;
        }

    }

}
?>
