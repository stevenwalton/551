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
                                         WHERE s.idState = ".$stateID.";")
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
                                         WHERE s.idSite = ".$siteID.";")
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
                                         WHERE a.idArea = ".$areaID.";")
        while($row = $stmt->fetch())
        {
           $name = $row['name'];
           echo($name);
           echo("<br>");
        }
        return 0; 
    }
}
?>
