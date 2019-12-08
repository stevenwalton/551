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

    public function addRoute($name, 
                             $site=NULL,
                             $area=NULL,
                             $numPitches=1, 
                             $approach=NULL, 
                             $description=NULL,
                             $likability=0,
                             $difficulty=0.0)
    {
        // Check that route name isn't used in the area or site
        if ($site == NULL and $area == NULL)
        {
            return 1;
        }
        elseif ($site == NULL)
        {
            // Does name exist in area already?
            $stmt = $this->connect()->query("SELECT COUNT(idArea) c FROM Area
                                             WHERE name = ".$name.";");
            $check = $stmt->fetch()['c'];
            if ($check > 0)
            {
                return 1;
            }
             
            // TODO: 
            // Handle no return
            
        }
        else if ($area == NULL)
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
        $stmt = $this->connect()->query("SELECT COUNT(idRoute) FROM Route;")

    }
}
?>
