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

    }
}
?>
