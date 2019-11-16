<?php
#include("connection.txt")

class Dbh {
    private $charset;
    private $servername;
    private $dbname;
    private $username;
    private $passwd;

    public function connect() {
        $this -> charset = "utf8mb4";
        $this -> servername = "localhost";
        $this -> dbname = "stores7";
        $this -> username = "walton";
        $this -> passwd = "toor";

        #try
        #{
        #    $dsn = "mysql:host=".$servername.";dbname=".$dbname.";charset=".$this->charset;
        #    $pdo = new PDO($dns, $username, $passwd);
        #    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        #    return $pdo;
        #} 
        #catch (PDOException $e)
        #{
        #    echo("Connection failed: ".$e -> getMessage();
        #}
        $dsn = "mysql:host=".$servername.";dbname=".$dbname.";charset=".$this->charset;
        $pdo = new PDO($dns, $username, $passwd);
        return $pdo;

    }
}
?>
