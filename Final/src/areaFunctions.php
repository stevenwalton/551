<?php
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
}
?>
