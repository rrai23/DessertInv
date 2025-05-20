<?php
session_start();

require 'db.php';
$id = $_GET['id'];
$image = $_FILES['item-image-input'];
$currentFileExtension = 'jpg';

//image processing
if (isset($image) && $image['error'] == UPLOAD_ERR_OK) {
    $sql = "SELECT image_path FROM $table WHERE id = $id";
    $result = $conn->query($sql);
    if($result && $result->num_rows > 0){
        $result = $result->fetch_assoc();
        $imagePath = $result['image_path'];
        $currentFileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $filePath = __DIR__ . $imagePath;
        if (file_exists($filePath)){
            unlink($filePath);
        }
    }
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $allowedMimeTypes = ['image/jpeg', 'image/png'];
    $fileExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    if(!in_array($image['type'], $allowedMimeTypes)) {
        echo "Error: Invalid File Type. Must be JPEG or PNG.";
        exit;
    } 
    if(!in_array($fileExtension, $allowedExtensions)) { 
        echo "Error: Invalid File Extension. Must be jpg/jpeg/png";
        exit;
    }
    if(empty($fileExtension)) { 
        echo "Error: File does not have file extension.";
        exit;
    }
}

//form data processing
$name = $_POST['item-name'];
$category = $_POST['item-category'];
$description = $_POST['item-description'];
$imagePath = "/image/" . str_replace(" ", "-", $name) . ".$currentFileExtension";
$filePath = __DIR__ . $imagePath;
$isAvailable = intval($_POST['item-is-available']);
$sellPrice = floatval($_POST['item-sell-price']);
$costPrice = floatval($_POST['item-cost-price']);
$quantity = intval($_POST['item-quantity']);

//getting original quantity
$sql = "SELECT quantity FROM $table WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$oldQty = $row['quantity'];

//database update
if($oldQty == $quantity){
    $sql = "UPDATE $table
    SET name = '$name', 
        category = '$category',
        description =  '$description',
        image_path = '$imagePath',
        is_available = $isAvailable,
        sell_price = $sellPrice,
        cost_price = $costPrice,
        quantity = $quantity
    WHERE id = $id";
} else {
    //setting last restocked to current datetime
    $lastRestocked = (new DateTime('now', new DateTimeZone('Asia/Manila')))->format('Y-m-d H:i:s');

    //submitting restock record
    $sql = "INSERT INTO restock_history (
        item_id, 
        datetime, 
        old_quantity, 
        quantity_added, 
        new_quantity, 
        updated_by
    ) VALUES (
        $id,
        '$lastRestocked',
        $oldQty,
        " . ($quantity-$oldQty) . ",
        $quantity,
        '" . $_SESSION['name'] . "'
    )";
    if($conn->query($sql) === TRUE){} 
    else echo "Error: $conn->error";
    


    //updating item
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
}

//if(!move_uploaded_file($image['tmp-name'], $filePath)) echo "Failed to upload  file";

if($conn->query($sql) === TRUE){
    header("Location: index.php?message=Item%20updated%20successfully!");
} 
else {
    $error = urlencode("Error Updating Item!");
    header("Location: edit-item-form.php?id=$id&error=$error");
    exit;
}
/* I dont want to go to another webpage if failed Editing
else {
    echo "Error updating item: " . $conn->error;
}
*/
$conn->close();
?>