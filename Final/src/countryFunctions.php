<?php
class Country extends Dbh
{
    // Country Functions
    public function listCountries()
    {
        $stmt = $this->connect()->query("SELECT * FROM Country;");
        while ($row = $stmt->fetch())
        {
            $name = $row['name'];
            echo("<a href=\"".$name."\">".$name."</a>");
            echo("<br>");
        }

    }

    public function getCountryID($name)
    {
        $stmt = $this->connect()->query("SELECT * FROM Country;");
        while ($row = $stmt->fetch())
        {
            if($name = $row['name'])
            {
                return $row['idCountry'];
            }
        }

    }

    public function addCountry($name)
    {
        $id = 0;
        $hem = NULL;
        # Check if country exists
        $stmt = $this->connect()->query("SELECT * FROM Country;");
        if(!(in_array($name,$stmt->fetch(),true)))
        {
            $stmt = $this->connect()->query("SELECT * FROM Country;");
            while ($row = $stmt->fetch())
            {
                if($id == $row['idCountry'])
                {
                    $id++;
                }
            }
            #echo("Adding ".$name." with id ".$id." and hemisphere ".$hem);
            
            # UNCOMMENT WHEN NOT TESTING
            #$inst = $this->connect()->query("INSERT INTO Country (idCountry, hemisphere, name) VALUES ('".$id."','".$hem."','".$name."');");
        }

    }
}
?>
