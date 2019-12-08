<?php
include_once "stateFunctions.php";

class Site extends Dbh
{
    public function listSites()
    {
        $stmt = $this->connect()->query("SELECT * FROM Site;");
        while ($row = $stmt->fetch())
        {
            $name = $row['name'];
            echo("<a href=\"".$name."\">".$name."</a>");
            echo("<br>");
        }

    }

    public function getSiteID($name)
    {
        $stmt = $this->connect()->query("SELECT * FROM Site;");
        while ($row = $stmt->fetch())
        {
            if ($name == $row['name'])
            {
                return $row['idSite'];
            }
        }
    }

    public function addSite($name,$state)
    {
        $id = 0;
        # Check if state exists
        $state = new State;
        $idState = $state->getStateID($state);

        $stmt = $this->connect()->query("SELECT * FROM Site;");
        # Only do if site doesn't already exist
        if(!(in_array($name,$stmt->fetch(),true)))
        {
            $stmt = $this->connect()->query("SELECT * FROM Site;");
            while ($row = $stmt->fetch())
            {
                if ($id == $row['idSite'])
                {
                    $id++;
                }
            }
            return array("id"=>$id, "state"=>$idState, "name"=>$name);
        }
    }
}
?>
