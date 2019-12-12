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


    public function getSitesInStateID($idState)
    {
        $sql = "SELECT site.name FROM site
                LEFT JOIN state using(idState)
                LEFT JOIN country using(idCountry)
                WHERE state.idState = ".$idState.";";
        $stmt = $this->connect()->query($sql);
        $sites = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $sites;
    }

    public function getSitesInStateNamed($state, $country)
    {
        $_state = new State;
        $idState = $_state->getStateID($state, $country);
        #echo("Got state ID: ".$idState."<br>");
        $sites = $this->getSitesInStateID($idState);
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

    public function getSiteID($name, $state=NULL, $country=NULL)
    {
        #echo("Inside siteID: ".$name." with state ".$state." and country ".$country."<br>");
        $id = 0;
        $stmt = $this->connect()->query("SELECT * FROM site;");
        while ($row = $stmt->fetch())
        {
            if ($name == $row['name'])
            {
                return $row['idSite'];
            }
            $id++;
        }
        #echo("Couldn't find site: ".$name."<br>");
        $_state = new State;
        $stateID = $_state->getStateID($state, $country);
        $state = $_state->getStateName($stateID);
        #echo("Adding site: ".$name." with ID: ".$id." in state ".$state." in country ".$country."<br>");
        $this->addSite($name, $state, $country);
        return $id;
    }

    public function getSiteName($id)
    {
        $stmt = $this->connect()->query("SELECT name FROM site
                                         WHERE idSite = ".$id.";");
        return $stmt->fetch()['name'];
    }

    public function addSite($name,$state,$country)
    {
        #echo("<fetching site with ".$name." ".$state);
        #echo("In addSite have name: ".$name." state: ".$state." country: ".$country."<br>");
        $id = 0;
        # Check if state exists
        $s = new State;
        ##echo("Fetching state ID for ".$state."<br>");
        $idState = $s->getStateID($state, $country);

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
            #echo("Running: ".$sql."<br>");
            try
            {
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
                #echo("<br>Success");
                $ret = system("python3 ../scripts/makeSiteFS.py --country ".$country." --state ".$state." --site ".$name, $retval);
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
