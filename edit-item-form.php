<?php
//fix the cancel button to redirect to index.php not edit-item.php
//make edit-item-functional
require 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM $table WHERE id = $id";
$result = $conn->query($sql);
if($result && $result->num_rows > 0) {
    $item = $result->fetch_assoc();

    $id = $item['id'];
    $name = $item['name'];
    $category = $item['category'];
    $description = $item['description'];
    $imagePath = ltrim($item['image_path'], '/');
    $lastRestocked = $item['last_restocked'];
    $isAvailable = ($item['quantity'] > 0) ? 1: 0;
    $sellPrice = number_format(floatval($item['sell_price']), 2);
    $costPrice = number_format(floatval($item['cost_price']), 2);
    $quantity = $item['quantity'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item | <?php echo $tableName; ?></title>
    <link rel="stylesheet" href="dist/styles.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-white p-2 shadow-md flex items-center justify-between px-8 mt">
        <div id="nav-header">
            <h1 class="text-3xl font-bold text-blue-500">Dessert Inventory</h1>
        </div>
        <div id="nav-buttons" class="flex space-x-4 mr-4">
            <a href='index.php#inventory-table-div'><button id="button-view-inv" class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition active">View inventory</button></a>
            <a href='index.php#add-item-form-div'><button id="button-add-item" class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Add Item</button></a>
        </div>
    </nav>

    <div id="edit-item-form-div">
        <div id="item-info" class="bg-white max-w-lg rounded-lg shadow-lg overflow-hidden mx-auto my-6 px-6 pt-2">
            <h1 class="text-xl font-semibold text-center mt-2">Edit Item</h1>
            <form id="edit-item-form" action="edit-item.php" method="post">
                <label for="item-name" class="font-medium">Item Name: </label><br>
                <input type="text" name="item-name" value="<?php echo $name; ?>" class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"><br>
                <label for="item-category" class="font-medium">Category: </label><br>
                <select name="item-category" class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="Frozen_Dessert" <?php echo ($category === "Frozen_Dessert") ? "selected" : NULL; ?>>Frozen Dessert</option>
                    <option value="Cold_Dessert" <?php echo ($category === "Cold_Dessert") ? "selected" : NULL; ?>>Cold Dessert</option>
                    <option value="Hot_Dessert" <?php echo ($category === "Hot_Dessert") ? "selected" : NULL; ?>>Hot Dessert</option>
                    <option value="Room_Temperature_Dessert" <?php echo ($category === "Room_Temperature_Dessert") ? "selected" : NULL; ?>>Room Temperature Dessert</option>
                    <option value="Bite-sized_Dessert" <?php echo ($category === "Bite-sized_Dessert") ? "selected" : NULL; ?>>Bite-sized Dessert</option>
                </select><br>
                <label for="item-description" class="font-medium">Description</label><br>
                <textarea
                name="item-description"
                rows="6" cols="50"
                class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
                placeholder="Enter a description of the item..."><?php echo $description; ?>
                </textarea><br>
                <div id="item-prices" class="flex space-x-4">
                    <div>
                        <label for="item-sell-price" class="font-medium">Selling Price: </label>
                        <input type="number" name="item-sell-price" value="<?php echo $sellPrice; ?>" step="0.01" class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"><br>
                    </div>
                    <div>
                        <label for="item-cost-price" class="font-medium">Cost Price: </label>
                        <input type="number" name="item-cost-price" value="<?php echo $costPrice; ?>" step="0.01" class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"><br>
                    </div>
                </div>
                <div id="item-stocks" class="flex space-x-4">
                    <div class="w-1/2">
                        <label for="item-quantity" class="font-medium">Quantity: </label>
                        <input type="number" name="item-quantity" value="<?php echo $quantity; ?>" step="1" class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"><br>
                    </div>
                    <div class="w-1/2">
                        <p class="font-medium">In Stock: </p>
                        <div id="in-stock-radio" class="flex items-center justify-evenly my-3">
                            <div id="in-stock-radio-true-div" class="items-center flex space-x-3">    
                                <label for="is-available-true" class="text-gray-700 font-medium cursor-pointer">TRUE</label>
                                <input type="radio" 
                                    name="item-is-available" 
                                    id="is-available-true" 
                                    value="1" <?php echo ($isAvailable === 1) ? "checked" : NULL; ?>
                                    class="cursor-pointer w-4 h-4 text-blue-500 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            </div>
                            <div id="in-stock-radio-false-div" class="items-center flex space-x-3">
                                <label for="is-available-false" class="text-gray-700 font-medium cursor-pointer">FALSE</label>
                                <input type="radio" 
                                    name="item-is-available" 
                                    id="is-available-false" 
                                    value="0" <?php echo ($isAvailable === 0) ? "checked" : NULL; ?>
                                    class="cursor-pointer w-4 h-4 text-blue-500 border-gray-300 focus:ring-blue-500 focus:ring-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-3">
                    <a href="./index.php"><button id="button-cancel-delete" class="w-57 cursor-pointer bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Cancel</button></a>
                    <input type="submit" value="Add Item" class="w-57 cursor-pointer px-6 py-2 bg-red-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                </div>
                <p class="text-center text-red-500 my-2">This action is <span class="font-semibold">PERMANENT</span></p>
            </form>
        </div>
    </div>
</body>
<script></script>
</html>