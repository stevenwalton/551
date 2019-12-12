<?php
class Pitch extends Dbh
{
    public function addPitch($num, $idRoute, $length, $diff, $rating)
    {
        $id = 0;
        $stmt = $this->connect()->query("SELECT count(idPitch) c FROM pitch;");
        $id = $stmt->fetch()['c'];
        $sql = "INSERT INTO pitch (idPitch, idRoute, length, difficulty, rating, pitchNum)
                VALUES('".$id."', '".$idRoute."', '".$length."', '".$diff."', '".$rating."', '".$num."');";
        $sql_bridge = "INSERT INTO route_has_pitch (Pitch_idPitch, Route_idRoute)
                       VALUES('".$id."', '".$idRoute."');";
        try
        {
            $stmt = $this->connect()->prepare($sql);
            $stmt_bridge = $this->connect()->prepare($sql_bridge);
            $stmt->execute();
            $stmt_bridge->execute();
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
