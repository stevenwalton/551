<?php
class Country extends Dbh
{
    public function listCountries()
    {
        $stmt = $this->connect()->query("SELECT * FROM country;");
        while ($row = $stmt->fetch())
        {
            $name = $row['name'];
            echo("<a href=\"".$name."\">".$name."</a>");
            echo("<br>");
        }
        return 0;

    }

    public function getAllCountries()
    {
        $sql = "SELECT * FROM country;";
        $stmt = $this->connect()->query($sql);
        $countries = $stmt->fetchAll(PDO::FETCH_COLUMN, 2);
        return $countries;
    }

    public function getCountryID($name)
    {
        #echo("Inside getCountryID<br>");
        $stmt = $this->connect()->query("SELECT * FROM country;");
        $id = 0;
        while ($row = $stmt->fetch())
        {
            if($name == $row['name'])
            {
                return $row['idCountry'];
            }
            $id++;
        }
        // Add a new country and return the id
        #echo("Adding new country called ".$name."<br>");
        #$rArray = $this->addCountry($name);
        $this->addCountry($name);
        #echo("Country id: ".$id." with name ".$name."<br>");
        return $id;
    }

    public function getCountryName($id)
    {
        //echo("<br>In func");
        $stmt = $this->connect()->query("SELECT name FROM country 
                                         WHERE idCountry = ".$id.";");
        //echo("<br>Finding name for country with ID: ".$id);
        return $stmt->fetch()['name'];
    }

    public function addCountry($name)
    {
        $id = 0;
        $hem = NULL;
        # Check if country exists
        $stmt = $this->connect()->query("SELECT * FROM country;");
        #echo("Before check we have name ".$name."<br>");
        if(!(in_array($name,$stmt->fetch(),true)))
        {
            $stmt = $this->connect()->query("SELECT * FROM country;");
            while ($row = $stmt->fetch())
            {
                if($id == $row['idCountry'])
                {
                    $id++;
                }
            }
            //echo("<br>Adding ".$name." with id ".$id." and hemisphere ".$hem);
            //echo("<br>");
            
            #echo("before insert<br>");
            # UNCOMMENT WHEN NOT TESTING
            if ($hem == NULL)
            {
                $sql = "INSERT INTO country (idCountry, hemisphere, name)
                        VALUES ('".$id."',NULL, '".$name."');";
                #echo("<br>Adding country ".$name." with ID ".$id."<br>");
            }
            else
            {
                $sql = "INSERT INTO country (idCountry, hemisphere, name)
                        VALUES ('".$id."','".$hem."', '".$name."');";
            }
            try
            {
                #echo("inserting: ".$sql." <br>");
                $stmt = $this->connect()->prepare($sql);
                #echo("prepared<br>");
                $stmt->execute();
                $ret = system("python ../skel/makeCountry.py -c ".$name, $retval);
                return 0;
            }
            catch(PDOException $e)
            {
                echo($sql."<br>".$e->getMessage());
                return 1;
            }
            #$inst = $this->connect()->query("INSERT INTO Country (idCountry, hemisphere, name) VALUES ('".$id."','".$hem."','".$name."');");
            #return array("id"=>$id, "hemisphere"=>$hem, "name"=>$name);
            return 0;
        }
        #echo("Country: ".$name." already exists.");
        return 1;

    }

    public function deleteByName($name)
    {
        try
        {
            $sql = "DELETE FROM country WHERE name = ".$name.";";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return 0;
        }
        catch(PDOException $e)
        {
            echo($sql."<br>".$e->getMessage());
            return 1;
        }
    }

    public function deleteByID($id)
    {
        try
        {
            $sql = "DELETE FROM country WHERE idCountry = ".$id.";";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
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
