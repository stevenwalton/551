<?php
include_once 'connect.php';
include_once 'databases.php';

$manu = $_POST['manu'];
$object = new Databases;
$object->getCustomers($manu);
?>
