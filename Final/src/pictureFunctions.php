<?php
class Picture extends Dbh
{
    public function allPicturesURLs()
    {
        $stmt = $this->connect()->query("SELECT pictureURL FROM pictures;");
        $pictures = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $pictures;
    }

    public function getPicturesInRouteID($idRoute)
    {
        $sql = "SELECT pictureURL FROM pictures p
                JOIN route_has_pictures rp ON p.idPictures = rp.Pictures_idPictures
                LEFT JOIN route r ON r.idRoute = rp.Route_idRoute;";
        $stmt = $this->connect()->query($sql);
        $pictures = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $pictures;
    }

    public function getPicturesByUserID($idUser)
    {
        $sql = "SELECT pictureURL FROM pictures p
                LEFT JOIN users u ON p.uploadedBY = u.idUsers;";
        $stmt = $this->connect()->query($sql);
        $pictures = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $pictures;
    }

    public function getPictureURL($id)
    {
        $sql = "SELECT pictureURL FROM pictures WHERE idPictures = ".$id.";";
        $stmt = $this->connect()->query($sql);
        $urls = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $urls;
    }

    public function addPicture($idRoute, $url, $by=NULL)
    {
        $id = 0;
        $stmt = $this->connect()->query("SELECT count(idPictures) c FROM pictures;");
        $id = $stmt->fetch()['c'];
        $sql_pic = "INSERT INTO pictures (idPictures, pictureURL, uploadedBy)
                    VALUES ('".$id."', '".$url."', '".$by."');";
        $sql_bridge = "INSERT INTO route_has_pictures (Route_idRoute, Pictures_idPictures)
                       VALUES ('".$idRoute."', '".$id."');";
        try
        {
            $stmt0 = $this->connect()->prepare($sql_pic);
            $stmt1 = $this->connect()->prepare($sql_bridge);
            $stmt0->execute();
            $stmt1->execute();
            return 0;
        }
        catch(PDOException $e)
        {
            echo($sql."<br>".$e->getMessage());
            return 1;
        }

    }

}
?>
