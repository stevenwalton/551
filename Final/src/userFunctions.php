<?php
class User extends Dbh
{
    public function listUsers()
    {
        $stmt = $this->connect()->query("SELECT * FROM users;");
        while ($row = $stmt->fetch())
        {
            $name = $row['name'];
            echo("<a href=\"".$name."\">".$name."</a>");
            echo("<br>");
        }
        return 0;
    }

    public function getUserName($id)
    {
        $stmt = $this->connect()->query("SELECT name FROM users
                                         WHERE idUsers = ".$id.";");
        return $stmt->fetch()['name'];
    }

    public function addUser($name)
    {
        $id = 0;
        $state = NULL;
        // TODO:
        // get state

        // TODO:
        //
    }
}
?>
