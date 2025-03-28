<?php
require 'db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM $table WHERE id = $id";
    echo $sql;
    if($conn->query($sql) === TRUE) {
        echo "Succesfully Deleted Item";
        header("Location: index.php?message=Succesfully%20Deleted%20Item");
    } else echo $conn->error;
} else echo "No ID provided";

$conn->close();
?>