<?php
require 'db.php';

$image = $_FILES['item-image-input'];
$name = isset($_POST["item-name"]) ? $conn->real_escape_string($_POST["item-name"]) : null;
$category = isset($_POST["item-category"]) ? $conn->real_escape_string($_POST["item-category"]) : null;
$description = isset($_POST["item-description"]) ? $conn->real_escape_string($_POST["item-description"]) : null;
$sell_price = isset($_POST["item-sell-price"]) ? $conn->real_escape_string($_POST["item-sell-price"]) : null;
$cost_price = isset($_POST["item-cost-price"]) ? $conn->real_escape_string($_POST["item-cost-price"]) : null;
$quantity = isset($_POST["item-quantity"]) ? $conn->real_escape_string($_POST["item-quantity"]) : null;
if($name && $category && $sell_price && $cost_price && $quantity){
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $allowedMimeTypes = ['image/jpeg', 'image/png'];
    if(!in_array($image['type'], $allowedMimeTypes)){
        echo "Error: Invalid file type. Must be JPEG or PNG."; 
    }
    $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    if(!in_array($fileExtension, $allowedExtensions)){
        echo "Error: Invalid file extension. Must be jpg/jpeg/png.";
    }
    if(empty($fileExtension)){
        echo "Error: Uploaded file does not have a valid extension";
    }
    $image_path = "/image/" . str_replace(" ", "-", $name) . ".$fileExtension";
    $file_path = __DIR__ . $image_path;

    $last_restocked = date("Y-m-d");
    $sell_price = floatval($sell_price);
    $cost_price = floatval($cost_price);

    $sql = "INSERT INTO $table 
    (name, category, description, image_path, last_restocked, sell_price, cost_price, quantity) 
    VALUES ('$name', '$category', '$description', '$image_path', '$last_restocked', $sell_price, $cost_price, $quantity)";
    if($conn->query($sql) === TRUE && move_uploaded_file($image['tmp_name'], $file_path)) {
        echo "$name added to $table";
        header("Location: index.php?message=$name%20added%20to%20table%20$table"); 
    } else echo "Error: $conn->error";
}

else echo "Invalid Request Method";

$conn->close();
?>