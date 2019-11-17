<?php
class Databases extends Dbh
{
    public function getAllOrders($col)
    {
        $stmt = $this->connect()->query("SELECT * FROM items;");
        while ($row = $stmt->fetch())
        {
            $order = $row[$col];
            echo($order);
            echo("<br>");
        }
        #return $order;
    }

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

    public function getManufacturers()
    {
        $stmt = $this->connect()->query("SELECT * FROM manufact;");
        while ($row = $stmt->fetch())
        {
            $manu_name = $row['manu_name'];
            $manu_code = $row['manu_code'];
            echo("Manufacturer code: ".$manu_code." for ".$manu_name);
            echo("<br>");
        }
    }

    public function getCustomers($manu_code)
    {
        $stmt = $this->connect()->query("SELECT
                                        CONCAT(c.fname,' ', c.lname) as name,
                                        s.description as des
                                        FROM customer c
                                        JOIN orders o USING(customer_num)
                                        JOIN items i USING(order_num)
                                        JOIN stock s USING(stock_num)
                                        JOIN manufact m ON m.manu_code = s.manu_code
                                        WHERE m.manu_code = '$manu_code'
                                        ;");
        echo("Customer Name\t\t | Description");
        echo("<br>");
        echo("---------------------------------------------");
        echo("<br>");
        while($row = $stmt->fetch())
        {
            $name = $row['name'];
            $des  = $row['des'];
            echo($name." | ".$des);
            echo("<br>");
        }
    }
}
?>
