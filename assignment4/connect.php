<?php
class Dbh 
{
    private $servername;
    private $dbname;
    private $username;
    private $passwd;
    private $charset;

    public function connect()
    {
        $this->servername = "localhost";
        $this->dbname = "stores7";
        $this->username = "steven";
        $this->passwd = "toor";
        $this->charset = "utf8mb4";

        try
        {
            $dsn = "mysql:host=".$this->servername.
                   ";dbname=".$this->dbname.
                   ";charset=".$this->charset;
            $pdo = new PDO($dsn, 
                           $this->username, 
                           $this->passwd);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch (PDOException $e)
        {
            echo("Connection failed: ".$e -> getMessage());
        }
    }
}
?>
