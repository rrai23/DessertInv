<?php
require 'db.php';
$id = $_GET['id'];
$image = $_FILES['item-image-input'];

$sql = "SELECT image_path FROM $table WHERE id = $id";
$result = $conn->query($sql);
if($result && $result->num_rows > 0){
    $result = $result->fetch_assoc();
    $imagePath = $result['image_path'];
    $filePath = __DIR__ . $imagePath;
    if (file_exists($filePath)){
        unlink($filePath);
    }
}
$name = $_POST['item-name'];
$category = $_POST['item-category'];
$description = $_POST['item-description'];
$imagePath = "/image/" . str_replace(" ", "-", $name) . ".jpg";
$filePath = __DIR__ . $imagePath;
$lastRestocked = $_POST['item-last-restocked'];
$isAvailable = intval($_POST['item-is-available']);
$sellPrice = floatval($_POST['item-sell-price']);
$costPrice = floatval($_POST['item-cost-price']);
$quantity = intval($_POST['item-quantity']);

$allowedExtensions = ['jpg', 'jpeg', 'png'];
$allowedMimeTypes = ['image/jpeg', 'image/png'];
$fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
if(!in_array($image['type'], $allowedMimeTypes)) echo "Error: Invalid File Type. Must be JPEG or PNG.";
if(!in_array($fileExtension, $allowedExtensions)) echo "Error: Invalid File Extension. Must be jpg/jpeg/png";
if(empty($fileExtension)) echo "Error: File does not have file extension.";

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

if($conn->query($sql) === TRUE && move_uploaded_file($image['tmp_name'], $filePath)){
    header("Location: index.php?message=Item%20updated%20successfully!");
} else echo "Error updating item: " . $conn->error;

$conn->close();
?>