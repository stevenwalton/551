<?php
include_once 'siteFunctions.php';

class Area extends Dbh
{
    public function listAreas()
    {
        $stmt = $this->connect()->query("SELECT * FROM Area;");
        while ($row = $stmt->fetch())
        {
            $name = $row['name'];
            echo("<a href=\"".$name."\">".$name."</a>");
            echo("<br>");
        }
        return 0;
    }

    public function getAllAreas()
    {
        $sql = "SELECT name FROM area;";
        $stmt = $this->connect()->query($sql);
        $areas = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $areas;
    }

    public function getAreasInSite($site)
    {
        $sql = "SELECT area.name FROM area
                JOIN site USING(idSite)
                WHERE site.name = ".$site.";";
        $stmt = $this->connect()->query($sql);
        $areas = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $areas;
    }

    public function getAreasInSiteID($idSite)
    {
        $sql = "SELECT area.name FROM area
                LEFT JOIN site USING(idSite)
                LEFT JOIN state USING(idState)
                LEFT JOIN country USING(idCountry)
                WHERE site.idSite = ".$idSite.";";
        $stmt = $this->connect()->query($sql);
        $areas = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $areas;
    }

    public function getAreasInSiteNamed($site,$state,$country)
    {
        $_site = new Site;
        $idSite = $_site->getSiteID($site,$state,$country);
        $areas = $this->getAreasInSiteID($idSite);
        return $areas;
    }

    public function getAreasInState($state)
    {
        $sql = "SELECT area.name FROM area
                JOIN site USING(idSite)
                JOIN state USING(idState)
                WHERE state.name = ".$state.";";
        $stmt = $this->connect()->query($sql);
        $areas = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $areas;
    }

    public function getAreasInCountry($country)
    {
        $sql = "SELECT area.name FROM area
                JOIN site USING(idSite)
                JOIN state USING(idState)
                JOIN country USING(idCountry)
                WHERE country.name = ".$country.";";
        $stmt = $this->connect()->query($sql);
        $areas = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $areas;
    }

    public function getAreaID($name, $site=NULL, $state=NULL, $country=NULL)
    {
        #echo("getArea ID<br>");
        $id = 0;
        $stmt = $this->connect()->query("SELECT * FROM area;");
        while ($row = $stmt->fetch())
        {
            if ($name == $row['name'])
            {
                return $row['idArea'];
            }
            $id++;
        }
        #echo("Couldn't find area: ".$name."<br>");
        $_site = new Site;
        $siteID = $_site->getSiteID($site, $state, $country);
        $site = $_site->getSiteName($siteID);
        #echo("Adding area: ".$name." with ID: ".$id." in site: ".$site."
        #      in state: ".$state." in country ".$country."<br>");
        $this->addArea($name, $site, $state, $country);
        return $id;
    }

    public function getSite($name)
    {
        $stmt = $this->connect()->query("SELECT idSite,s.name FROM Area
                                         LEFT JOIN Site
                                         WHERE name = ".$name.";");
        $row = $stmt->fetch();
        $idSite = $row['idSite'];
        $siteName = $row['name'];
        return array("id"=>$idSite, "name"=>$siteName);
    }

    public function addArea($name, $site, $state=NULL, $country=NULL)
    {
        #echo("<br>In add area with ".$name." and ".$site." in state ".$state." in country ".$country."<br>");
        $id = 0;
        # Check for matching site
        $_site = new Site;
        $idSite = $_site->getSiteID($site, $state, $country);
        #echo("<br>Got siteID: ".$idSite);

        $stmt = $this->connect()->query("SELECT * FROM area;");
        # only if area doesn't exist
        if(!(in_array($name, $stmt->fetch(),true)))
        {
            $stmt = $this->connect()->query("SELECT * FROM area;");
            while ($row = $stmt->fetch())
            {
                if ($id == $row['idArea'])
                {
                    $id++;
                }
            }
            $sql = "INSERT INTO area (idArea, idSite, name)
                    VALUES ('".$id."', '".$idSite."', '".$name."');";
            #echo("<br>Running ".$sql);
            try
            {
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
                #echo("<br>Success");
                return 0;
            }
            catch(PDOException $e)
            {
                echo("<br>".$e->getMessage());
                return 1;
            }
        }
    }
}
?>
