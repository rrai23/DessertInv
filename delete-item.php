<?php
require 'db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT image_path FROM $table WHERE id = $id";
    $result = $conn->query($sql);
    if($result && $result->num_rows > 0) {
        $result = $result->fetch_assoc();
        $imagePath = $result['image_path'];
        $filePath = __DIR__ . $imagePath;
        if(file_exists($filePath)){
            unlink($filePath);
        }
    }

    $sql = "DELETE FROM $table WHERE id = $id";
    if($conn->query($sql) === TRUE) {
        echo "Succesfully Deleted Item";
        header("Location: index.php?message=Succesfully%20Deleted%20Item");
        exit;
    } else echo $conn->error;
} else echo "No ID provided";

$conn->close();
?>