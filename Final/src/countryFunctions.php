<?php
class Country extends Dbh
{
    public function listCountries()
    {
        $stmt = $this->connect()->query("SELECT * FROM Country;");
        while ($row = $stmt->fetch())
        {
            $name = $row['name'];
            echo("<a href=\"".$name."\">".$name."</a>");
            echo("<br>");
        }
        return 0;

    }

    public function getCountryID($name)
    {
        $stmt = $this->connect()->query("SELECT * FROM Country;");
        while ($row = $stmt->fetch())
        {
            if($name == $row['name'])
            {
                return $row['idCountry'];
            }
        }
        //echo("Adding new country called ".$name);
        $rArray = $this->addCountry($name);
        $id = $rArray['id'];
        //$hem = $rArray['hemisphere'];
        $cName = $rArray['name'];
        //echo("Country id: ".$id." with name ".$cName."<br>");
        return $id;
    }

    public function getCountryName($id)
    {
        //echo("<br>In func");
        $stmt = $this->connect()->query("SELECT name FROM Country 
                                         WHERE idCountry = ".$id.";");
        //echo("<br>Finding name for country with ID: ".$id);
        return $stmt->fetch()['name'];
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
            //echo("<br>Adding ".$name." with id ".$id." and hemisphere ".$hem);
            //echo("<br>");
            
            # UNCOMMENT WHEN NOT TESTING
            #$inst = $this->connect()->query("INSERT INTO Country (idCountry, hemisphere, name) VALUES ('".$id."','".$hem."','".$name."');");
            return array("id"=>$id, "hemisphere"=>$hem, "name"=>$name);
        }

    }
}
?>
