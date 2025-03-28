<?php
require 'db.php';
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Item | <?php echo $tableName; ?></title>
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

    <div id="item-info-div" class="max-w-lg rounded-xl bg-white shadow-lg overflow-hidden mx-auto mt-6 p-6 px-7">
        <div class="item-info">
            <!--<img alt="selected item image">-->
            <h1 class="text-xl font-semibold text-center">Item Name</h1>
            <h2 class="text-sm text-center text-blue-500 mb-3">Item Category</h2>
            <p class="text-md text-justify mb-4">This item is a versatile and reliable addition to any collection. Designed with practicality in mind, it offers functionality and simplicity that suit a variety of needs. Whether you're looking for something to enhance your daily routine or a thoughtful gift for someone special, this item delivers consistent performance and quality. Its neutral design ensures it seamlessly complements any environment or purpose. A dependable choice for all occasions.</p>
            <div id="middle-info" class="flex flex-row">
                <div id="last-restocked-info" class="w-1/2">
                    <p class="text-md text-blue-500">Last Restock:</p>
                    <h2 class="text-2xl">2005-05-19</h2>
                </div>
                <div id="is-available-info" class="w-1/4">
                    <p class="text-md text-blue-500">Is Available:</p>
                    <h2 class="text-2xl">Yes</h2>
                </div>
                <div id="quantity-info" class="w-1/4 pl-4">
                    <p class="text-md text-blue-500">Quantity:</p>
                    <h2 class="text-2xl">500</h2>
                </div>
            </div>
            <div id="bottom-info" class="flex flex-row items-center justify-evenly">
                <div id="cost-price-info" class="w-1/2">
                    <p class="text-md text-blue-500">Cost Price:</p>
                    <h2 class="text-2xl">₱500.00</h2>
                </div>
                <div id="sale-price-info" class="w-1/2">
                    <p class="text-md text-blue-500">Sale Price:</p>
                    <h2 class="text-2xl">₱500.00</h2>
                </div>
            </div> 
        </div>
        <div id="item-buttons" class="max-w-full justify-between mt-4 mb-2">
            <a href="index.php"><button id="button-cancel-delete" class="w-56 cursor-pointer bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Cancel</button></a>
            <a href="delete-item.php?id=<?php echo $_GET['id']; ?>"><button id="button-delete-item" class="w-56 cursor-pointer bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition">Delete Item</button></a>
        </div>
        <p class="text-center text-red-500">This action is <span class="font-semibold">PERMANENT</span></p>
    </div>
</body>
<script></script>
</html>