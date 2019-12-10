<?php
include_once "stateFunctions.php";

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

    public function getRoutesInSite($site)
    {
        $sql = "SELECT route.name FROM route 
                JOIN site USING(idSite)
                WHERE site.name = ".$site.";";
        $stmt = $this->connect()->query($sql);
        $routes = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $routes;
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
                             $siteName=NULL,
                             $areaName=NULL,
                             $numPitches=1, 
                             $type=NULL,
                             $approach=NULL, 
                             $description=NULL,
                             $likability=0,
                             $difficulty=0.0)
    {
        // Check that route name isn't used in the area or site
        if ($siteName == NULL and $areaName == NULL)
        {
            return 1;
        }
        elseif ($siteName == NULL)
        {
            // Does name exist in area already?
            // FIX
            $stmt = $this->connect()->query("SELECT COUNT(idArea) c FROM area
                                             WHERE name = ".$name.";");
            $check = $stmt->fetch()['c'];
            if ($check > 0)
            {
                return 1;
            }
            $a = new Area;
            $areaID = $a.getAreaID($areaName);
            $rArr = $a.getSite($areaName);
            $siteID = $rArr['id'];
            $siteName = $rArr['name'];
             
            // TODO: 
            // Handle no return
            
        }
        else if ($areaName == NULL)
        {
            // Get Area
        }
        else // We just require Area, could reorder ifs
        {
            $area = new Area;
            $stmt = $this->connect()-query("SELECT idSite, idArea FROM area a
                                            WHERE a.name = ".$name.";");
            $row = $stmt->fetch();
            $siteID = $row['idSite'];
            $areaID = $row['idArea'];
        }
        // Get number of routes 
        $stmt = $this->connect()->query("SELECT COUNT(idRoute) c FROM route;");
        $id = $stmt->fetch()['c'];

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
                                           '".$siteID."',
                                           '".$areaID."',
                                           '".$difficulty."',
                                           '".$likability."',
                                           '0','0');";
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
        return 0;

    }
}
?>
