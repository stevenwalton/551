<?php
class Dbh 
{
    private $servername;
    private $dbname;
    private $username;
    private $passwd;
    private $charset;
    private $pdo;

    public function connect()
    {
        $this->servername = "ix.cs.uoregon.edu:3875";
        $this->dbname = "climbing";
        $this->username = "guest";
        $this->passwd = "";
        $this->charset = "utf8mb4";

        try
        {
            $dsn = "mysql:host=".$this->servername.
                   ";dbname=".$this->dbname.
                   ";charset=".$this->charset;
            $this->pdo = new PDO($dsn, 
                           $this->username, 
                           $this->passwd);
            $this->pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }
        catch (PDOException $e)
        {
            echo("Connection failed: ".$e -> getMessage());
        }
    }
}
?>
