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

    public function getAreasBySite($siteID)
    {
        $sql = "SELECT name FROM area WHERE idSite = ".$siteID.";";
        $stmt = $this->connect()->query($sql);
        $areas = $stmt->fetchAll(PDO::FETCH_COLUMN,2);
        return $areas;
    }

    public function getAreaID($name)
    {
        $stmt = $this->connect()->query("SELECT idArea FROM Area
                                         WHERE name = ".$name.";");
        return $stmt->fetch()['idArea'];
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

    public function addArea($name, $site)
    {
        echo("<br>In add area with ".$name." and ".$site);
        $id = 0;
        # Check for matching site
        $_site = new Site;
        $idSite = $_site->getSiteID($site);
        echo("<br>Got siteID: ".$idSite);

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
            echo("<br>Running ".$sql);
            try
            {
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
                echo("<br>Success");
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
