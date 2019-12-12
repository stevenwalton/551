<?php
include_once "basicFunctions.php";
include_once "stateFunctions.php";
include_once "siteFunctions.php";
include_once "areaFunctions.php";
include_once "pictureFunctions.php";

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

    public function getAllRoutes()
    {
        $sql = "SELECT name FROM route;";
        $stmt = $this->connect()->query($sql);
        $routes = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $routes;
    }

    public function getAllRoutesByPop()
    {
        $sql = "SELECT name FROM route
                ORDER BY likability DESC,
                difficulty ASC;";
        $stmt = $this->connect()->query($sql);
        $routes = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $routes;
    }

    public function getRoutePop($idRoute)
    {
        $sql = "SELECT likability FROM route WHERE idRoute = ".$idRoute.";";
        $stmt = $this->connect()->query($sql);
        $like = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $like;
    }

    public function searchRoutes($country=NULL,
                                 $state=NULL,
                                 $site=NULL,
                                 $area=NULL,
                                 $like=NULL,
                                 $diff=NULL,
                                 $type=NULL,
                                 $nPitch=NULL)
    {
        $sql = "SELECT route.name FROM route
                LEFT JOIN area USING(idArea)
                LEFT JOIN site ON route.idSite = site.idSite
                LEFT JOIN state USING(idState)
                LEFT JOIN country USING(idCountry)";
/*
        $arr = array("country"=>NULL,
                     "state"=>NULL,
                     "site"=>NULL,
                     "area"=>NULL,
                     "like"=>NULL,
                     "diff"=>NULL,
                     "type"=>NULL,
                     "nPitch"=>NULL);
 */

        if($country) $arr['country'] = "country.name = '".$country."'";
        if($state) $arr['state'] = "state.name = '".$state."'";
        if($site) $arr['site'] = "site.name = '".$site."'";
        if($area) $arr['area'] = "area.name = '".$area."'";
        if($like)
        {
            if($like < 10)
            {
                $arr['like'] = "route.likability = ".$like;
            }
            else
            {
                $arr['like'] = "route.likability >= 10";
            }
        }
        if($diff) $arr['diff'] = "route.difficulty = ".$diff;
        if($type) $arr['type'] = "route.type = '".$type."'";
        if($nPitch)
        {
            if($nPitch < 10)
            {
                $arr['nPitch'] = "route.numPitches = ".$nPitch;
            }
            else
            {
                $arr['nPitch'] = "route.numPitches >= 10";
            }
        }
        $i = 0;
        foreach($arr as $a)
        {
            if($a)
            {
                if($i == 0)
                {
                    $sql = $sql." WHERE ".$a;
                    $i++;
                }
                else
                {
                    $sql = $sql." AND ".$a;
                }
            }
        }
        $sql = $sql.";";
        echo($sql."<BR>");
        $stmt = $this->connect()->query($sql);
        $routes = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $routes;
    }

    public function getRouteDifficulty($idRoute)
    {
        $sql = "SELECT difficulty FROM route where idRoute = ".$idRoute.";";
        $stmt = $this->connect()->query($sql);
        $diff = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $diff;
    }

    public function getRouteID($name)
    {
        $sql = "SELECT route.idRoute FROM route
                WHERE route.name = '".$name."';";
        $stmt = $this->connect()->query($sql);
        $id = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $id;
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
                             $type="trad",
                             $approach=NULL, 
                             $description=NULL,
                             $likability=0,
                             $difficulty=0.0)
    {
        #echo("In addRoute<br>");
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
        /*
        echo("Have country: ".$country." in state: ".$state." at site: ".$site."
              in area ".$area." with route name: ".$name."<br>");
         */
        $stmt = $this->connect()->query("SELECT * FROM route;");
        if(!(in_array($name,$stmt->fetch(),true)))
        {
            $stmt = $this->connect()->query("SELECT count(idRoute) c FROM route;");
            $id = $stmt->fetch()['c'];
            #echo("New method to grab id gives: ".$id."<br>");

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
                                               '1','1');";
            #echo("Inserting: <br>".$sql."<br>");
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
