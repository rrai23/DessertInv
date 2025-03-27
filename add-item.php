<?php
require 'db.php';

$table = "crem_de_la_crem";

$name = $_GET["item-name"];
$category = $_GET["item-category"];
$description = $_GET["item-description"];
$image_path = "/image/" . str_replace(" ", "-", $name) . ".jpg";
$last_restocked = date("Y-m-d");
$sell_price = $_GET["item-sell-price"];
$cost_price = $_GET["item-cost-price"];
$quantity = $_GET["item-quantity"];

$sql = "INSERT INTO $table 
(name, category, description, image_path, last_restocked, sell_price, cost_price, quantity) 
VALUES ('$name', '$category', '$description', '$image_path', '$last_restocked', $sell_price, $cost_price, $quantity)";

if($conn->query($sql) === TRUE){
    $message = "$name added to $table successfully";
} else {
    $message = "Error: $conn->error";
}

echo "<script>alert('$message')</script>";
?>