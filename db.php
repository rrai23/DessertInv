<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "dessert_inventory";

$table = "crem_de_la_crem";
$tableName = strtoupper(str_replace("_", " ", $table));

$conn = new mysqli($host, $username, $password, $dbname,3306);
if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}
?>