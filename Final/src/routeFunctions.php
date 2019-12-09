<?php
include_once "stateFunctions.php";

class Route extends Dbh
{
    public function listRoutes()
    {
        $stmt = $this->connect()->query("SELECT * FROM Routes;");
        while($row = $stmt->fetch())
        {
            $name = $row['name'];
            echo($name);
            echo("<br>");
        }
    }

    public function listRoutesByState($state)
    {
        // Not ready!
        $st = new State;
        $stateID = getStateID($state);
        $stmt = $this->connect()->query("SELECT name FROM Routes r
                                         LEFT JOIN Area a
                                         LEFT JOIN Site si
                                         LEFT JOIN State s
                                         WHERE s.idState = ".$stateID.";");
        while($row = $stmt->fetch())
        {
           $name = $row['name'];
           echo($name);
           echo("<br>");
        }
        return 0; 
    }

    public function listRoutesBySite($site)
    {
        $st = new Site;
        $siteID = getSiteID($site);
        $stmt = $this->connect()->query("SELECT name FROM Routes r
                                         LEFT JOIN Area a
                                         LEFT JOIN Site s
                                         WHERE s.idSite = ".$siteID.";");
        while($row = $stmt->fetch())
        {
           $name = $row['name'];
           echo($name);
           echo("<br>");
        }
        return 0; 
    }

    public function listRoutesByArea($area)
    {
        $st = new Area;
        $areaID = getAreaID($area);
        $stmt = $this->connect()->query("SELECT name FROM Routes r
                                         LEFT JOIN Area a
                                         WHERE a.idArea = ".$areaID.";");
        while($row = $stmt->fetch())
        {
           $name = $row['name'];
           echo($name);
           echo("<br>");
        }
        return 0; 
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
        $stmt = $this->connect()->query("SELECT likability, likeVotes FROM Route
                                         WHERE idRoute = ".$id.";");
        // TODO: if more than one row returned
        $row = $stmt->fetch();
        $N = $row['likeVotes'];
        $like = $row['likability'];

        $newLike = (($like * $N) + $vote) / ($N + 1);
        $N++;
        // Update vote and number of likes (+1)
        $sql = "UPDATE Route SET likability=".$newLike.", likeVotes=".$N."
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
        $sql = "SELECT difficulty, diffVotes FROM Route WHERE idRoute = ".$id.";";
        $stmt = $this->connect()->query($sql);
        // TODO: Nothing returned or more than one
        $row = $stmt->fetch();
        $diff = $row['difficulty'];
        $N = $row['diffVotes'];
        $newDiff = (($diff * $N) + $vote) / ($N + 1);
        $N++;
        // Update vote 
        $sql = "UPDATE Route SET difficulty=".$newDiff.", diffVotes=".$N."
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
            $stmt = $this->connect()->query("SELECT COUNT(idArea) c FROM Area
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
            $stmt = $this->connect()-query("SELECT idSite, idArea FROM Area a
                                            WHERE a.name = ".$name.";");
            $row = $stmt->fetch();
            $siteID = $row['idSite'];
            $areaID = $row['idArea'];
        }
        // Get number of routes 
        $stmt = $this->connect()->query("SELECT COUNT(idRoute) c FROM Route;");
        $id = $stmt->fetch()['c'];

        $sql = "INSERT INTO Route (idRoute,
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
