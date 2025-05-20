<?php
require 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "UPDATE $table SET active = 1 WHERE id = $id";
    if($conn->query($sql) === TRUE){
        echo "Successfully Restored Item";
        header("Location: index.php?message=Succesfully%20Restored%20Item");
        exit;
    } else {
        echo $conn->error;
    }
} else {
    echo "No ID Provided";
}

$conn->close();
?>