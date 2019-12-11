<?php
include_once 'countryFunctions.php';

class State extends Dbh
{
    public function listStates()
    {
        $stmt = $this->connect()->query("SELECT * FROM state;");
        while ($row = $stmt->fetch())
        {
            $name = $row['name'];
            echo("<a href=\"".$name."\">".$name."</a>");
            echo("<br>");
        }
        return 0;
    }

    public function getAllStates()
    {
        $sql = "SELECT * FROM state;";
        $stmt = $this->connect()->query($sql);
        $states = $stmt->fetchAll(PDO::FETCH_COLUMN,2);
        return $states;
    }

    public function getStates($countryID)
    {
        $sql = "SELECT * FROM state WHERE idCountry = ".$countryID.";";
        $stmt = $this->connect()->query($sql);
        $states = $stmt->fetchAll(PDO::FETCH_COLUMN,2);
        return $states;
    }

    public function getStatesInCountryID($countryID)
    {
        $sql = "SELECT state.name FROM state 
                LEFT JOIN country USING(idCountry)
                WHERE country.idCountry = ".$countryID.";";
        $stmt = $this->connect()->query($sql);
        $states = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $states;
    }

    public function getStatesInCountryNamed($country)
    {
        $_country = new Country;
        $idCountry = $_country->getCountryID($country);
        #echo("Got country ID: ".$idCountry." for country: ".$country."<br>");
        $states = $this->getStatesInCountryID($idCountry);
        return $states;
    }

    public function getStatesIDsInCountry($countryID)
    {
        $sql = "SELECT idState FROM state LEFT JOIN country USING(idCountry);";
        $stmt = $this->connect()->query($sql);
        $states = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
        return $states;
    }

    public function getStateID($name, $country=NULL)
    {
        echo("Inside stateID: ".$name."<br>");
        $stmt = $this->connect()->query("SELECT * FROM state;");
        echo("looking for state with name: ".$name."<br>");
        $id = 0;
        while ($row = $stmt->fetch())
        {
            if($name == $row['name'])
            {
                echo("Found state: ".$name." with ID: ".$row['idState']."<br>");
                return $row['idState'];
            }
            $id++;
        }
        echo("Couldn't find state: ".$name."<br>");
        $_country = new Country;
        $countryID = $_country->getCountryID($country);
        $country = $_country->getCountryName($countryID);
        #$rArray = $this->addState($name,$country);
        echo("Adding state: ".$name." with ID: ".$id." in country: ".$country."<br>");
        $this->addState($name,$country);
        return $id;
    }

    public function getStateName($id)
    {
        $stmt = $this->connect()->query("SELECT name FROM state
                                         WHERE idState = ".$id.";");
        return $stmt->fetch()['name'];
    }

    public function addState($name,$country=NULL)
    {
        echo("In addState<br>");
        $id = 0;
        # Check if country exists
        $cnt = new Country;
        $idCountry = $cnt->getCountryID($country);
        echo("Country: ".$country." CountryID: ".$idCountry."<br>");
        $stmt = $this->connect()->query("SELECT * FROM state;");
        if(!(in_array($name,$stmt->fetch(),true)))
        {
            echo("Country: ".$country." was found<br>");
            $stmt = $this->connect()->query("SELECT * FROM state;");
            while ($row = $stmt->fetch())
            {
                if($id == $row['idState'])
                {
                    $id++;
                }
            }
            #echo("Adding state ".$name." with country ID ".$idCountry." and state id ".$id);
            $sql = "INSERT INTO state (idState, idCountry, name) 
                    VALUES ('".$id."', '".$idCountry."','".$name."');";
            
            echo("Inserting: ".$sql."<br>");
            try
            {
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
}
?>
