<?php
require 'db.php';

$table = "crem_de_la_crem";

$sql = "SELECT * FROM $table";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    echo "<table border='1' style='border-collapse: collapse; width: 100%; text-align: left;'>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Description</th>
        <th>Image Path</th>
        <th>Last Restocked</th>
        <th>In Stock</th>
        <th>Sell Price</th>
        <th>Cost Price</th>
        <th>Quantity</th>
        <th></th>
        <th></th>
    </tr>";

    while ($row = $result->fetch_assoc()){
        $shortDesc = strlen($row["description"]) > 40 ? substr($row["description"], 0, 40) : $row["description"];
        $row["description"] = !empty($row["description"]) ? $row["description"] : "No description available.";
        echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["name"] . "</td>
            <td>" . $row["category"] . "</td>
            <td>
                <div class='description-container'>
                    <span class='short-description'>
                        " . htmlspecialchars($shortDesc) . "
                        <a href='#' class='expand-link'>...</a>
                    </span>
                    <span class='full-description hidden'>
                        " . htmlspecialchars($row["description"]) . " 
                        <a href='#' class='collapse-link'>[Hide]</a>
                    </span>
                </div>
            </td>
            <td>" . $row["image_path"] . "</td>
            <td>" . $row["last_restocked"] . "</td>
            <td>" . $row["is_available"] . "</td>
            <td>" . $row["sell_price"] . "</td>
            <td>" . $row["cost_price"] . "</td>
            <td>" . $row["quantity"] . "</td>
            <td><a href='edit-item.php'><img src='src/edit.png' alt='edit' width='20px'></a></td>
            <td><a href='delete-item.php'><img src='src/delete.png' alt='delete' width='20px'></a></td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results found.";
}

$conn->close();
?>