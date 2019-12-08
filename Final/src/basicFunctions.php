<?php
class Basic extends Dbh
{
    public function getTables()
    {
        $stmt = $this->connect()->query("show tables;");
        while ($row = $stmt->fetch())
        {
            $item = $row[0];
            echo($item);
            echo("<br>");
        }
    }
}
?>
