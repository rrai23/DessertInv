<?php
require 'db.php';

$table = "crem_de_la_crem";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = isset($_POST["item-name"]) ? $conn->real_escape_string($_POST["item-name"]) : null;
    $category = isset($_POST["item-category"]) ? $conn->real_escape_string($_POST["item-category"]) : null;
    $description = isset($_POST["item-description"]) ? $conn->real_escape_string($_POST["item-description"]) : null;
    $sell_price = isset($_POST["item-sell-price"]) ? $conn->real_escape_string($_POST["item-sell-price"]) : null;
    $cost_price = isset($_POST["item-cost-price"]) ? $conn->real_escape_string($_POST["item-cost-price"]) : null;
    $quantity = isset($_POST["item-quantity"]) ? $conn->real_escape_string($_POST["item-quantity"]) : null;
    if($name && $category && $sell_price && $cost_price && $quantity){
        $image_path = "/image/" . str_replace(" ", "-", $name) . ".jpg";
        $last_restocked = date("Y-m-d");

        $sql = "INSERT INTO $table 
        (name, category, description, image_path, last_restocked, sell_price, cost_price, quantity) 
        VALUES ('$name', '$category', '$description', '$image_path', '$last_restocked', $sell_price, $cost_price, $quantity)";
        if($conn->query($sql) === TRUE) {
            echo "$name added to $table";
            header("Location: index.php?message=$name%20added%20to%20table%20$table"); 
        } else echo "ERror: $conn->error";
    }
} 
else echo "Invalid Request Method";

$conn->close();
?>