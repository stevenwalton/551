<?php
include_once "stateFunctions.php";

class Site extends Dbh
{
    public function listSites()
    {
        $stmt = $this->connect()->query("SELECT * FROM site;");
        while ($row = $stmt->fetch())
        {
            $name = $row['name'];
            echo("<a href=\"".$name."\">".$name."</a>");
            echo("<br>");
        }

    }

    public function getAllSites()
    {
        $stmt = $this->connect()->query("SELECT * FROM site;");
        $sites = $stmt->fetchAll(PDO::FETCH_COLUMN,2);
        return $sites;
    }

    public function getAllSitesInState($state)
    {
        $sql = "SELECT site.name FROM site 
                LEFT JOIN state USING(idState)
                WHERE state.name = ".$state.";";
        $stmt = $this->connect()->query($sql);
        $sites = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $sites;
    }

    public function getAllSitesInCountry($country)
    {
        $sql = "SELECT site.name FROM site 
                LEFT JOIN state USING(idState)
                LEFT JOIN country USING(idCountry)
                WHERE country.name = ".$country.";";
        $stmt = $this->connect()->query($sql);
        $sites = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $sites;
    }

    public function getSites($stateID)
    {
        $sql = "SELECT * FROM site WHERE idState = ".$stateID.";";
        $stmt = $this->connect()->query($sql);
        $sites = $stmt->fetchAll(PDO::FETCH_COLUMN,2);
        return $sites;
    }

    public function getSiteID($name)
    {
        $stmt = $this->connect()->query("SELECT * FROM site;");
        while ($row = $stmt->fetch())
        {
            if ($name == $row['name'])
            {
                return $row['idSite'];
            }
        }
    }

    public function addSite($name,$state,$country)
    {
        #echo("<fetching site with ".$name." ".$state);
        echo("In addSite");
        $id = 0;
        # Check if state exists
        $s = new State;
        #echo("<br>Fetching state ID for ".$state);
        $idState = $s->getStateID($state);

        $stmt = $this->connect()->query("SELECT * FROM site;");
        # Only do if site doesn't already exist
        if(!(in_array($name,$stmt->fetch(),true)))
        {
            $stmt = $this->connect()->query("SELECT * FROM site;");
            while ($row = $stmt->fetch())
            {
                if ($id == $row['idSite'])
                {
                    $id++;
                }
            }
            $sql = "INSERT INTO site (idSite, idState, name)
                    VALUES ('".$id."', '".$idState."', '".$name."');";
            echo("Running: ".$sql."<br>");
            try
            {
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
                echo("<br>Success");
                return 0;
            }
            catch(PDOException $e)
            {
                echo($sql."<br>".$e->getMessage());
                return 1;
            }
            return array("id"=>$id, "state"=>$idState, "name"=>$name);
        }
    }

}
?>
