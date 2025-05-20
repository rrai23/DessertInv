<?php
require 'db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE $table SET active = 0 WHERE id = $id";
    if($conn->query($sql) === TRUE) {
        echo "Succesfully Deactivated Item";
        header("Location: index.php?message=Succesfully%20Deactivated%20Item");
        exit;
    } else echo $conn->error;
} else echo "No ID provided";

$conn->close();
?>