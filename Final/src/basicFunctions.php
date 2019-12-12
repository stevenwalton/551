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

    public function difficultyToNumber($diff_major, $diff_minor)
    {
        if($diff_minor == NULL) $diff_minor = 'a';
        if ($diff_major < 10)
        {
            switch($diff_minor)
            {
            case 'a':
            case 'b':
                break;
            case 'c':
            case 'd':
                $diff_major++;
                break;
            default:
                echo("Error: got (".$diff_major.",".$diff_minor."<br>");
                return 1;
            }
            $diff_minor = 0;
        }
        else
        {
            switch($diff_minor)
            {
                case 'a':
                    $diff_minor = 0;
                    break;
                case 'b':
                    $diff_minor = 0.25;
                    break;
                case 'c':
                    $diff_minor = 0.5;
                    break;
                case 'd':
                    $diff_minor = 0.75;
                    break;
                default:
                    echo("Error: got (".$diff_major.",".$diff_minor."<br>");
                    return 1;

            }
        }
        $difficulty = $diff_major + $diff_minor;
        return $difficulty;
    }

    public function difficultyToYDS($difficulty)
    {
        if ($difficulty < 10)
        {
            #echo("flooring<br>");
            return array("major"=>floor($difficulty),"minor"=>NULL);
        }
        $diff_major = floor($difficulty);
        $diff_minor = $difficulty - $diff_major;
        switch($diff_minor)
        {
            case '0':
                $diff_minor = 'a';
                break;
            case '0.25':
                $diff_minor = 'b';
                break;
            case '0.5':
                $diff_minor = 'c';
                break;
            case '0.75':
                $diff_minor = 'd';
                break;
            default:
                echo("Error: got (".$diff_major.",".$diff_minor."<br>");
                return 1;
        }
        $maj = floor($diff_major);
        #echo("Major: ".$maj);
        $min = $diff_minor;
        #echo("Minor: ".$min);
        return array("major"=>$maj, "minor"=>$min);
    }

    /*
    public function endswith($string, $end)
    {
        $len = strlen($end);
        return (substr($string, 0, $
    }
     */
}
?>
