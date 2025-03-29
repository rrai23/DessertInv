<?php
require 'db.php';

$id = $_GET['id'];
$name = $_POST['item-name'];
$category = $_POST['item-category'];
$description = $_POST['item-description'];
$imagePath = "/image/" . str_replace(" ", "-", $name) . ".jpg";
$lastRestocked = $_POST['item-last-restocked'];
$isAvailable = intval($_POST['item-is-available']);
$sellPrice = floatval($_POST['item-sell-price']);
$costPrice = floatval($_POST['item-cost-price']);
$quantity = intval($_POST['item-quantity']);
$sql = "UPDATE $table
    SET name = '$name', 
        category = '$category',
        description =  '$description',
        image_path = '$imagePath',
        last_restocked = '$lastRestocked',
        is_available = $isAvailable,
        sell_price = $sellPrice,
        cost_price = $costPrice,
        quantity = $quantity
    WHERE id = $id";

if($conn->query($sql) === TRUE){
    header("Location: index.php?message=Item%20updated%20successfully!");
} else echo "Error updating item: " . $conn->error;

$conn->close();
?>