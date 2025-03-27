<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crem de la Crem | Inventory</title>
    <link rel="stylesheet" href="dist/styles.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-white p-2 shadow-md flex items-center justify-between px-8 mt">
        <div id="nav-header">
            <h1 class="text-3xl font-bold text-blue-500">Dessert Inventory</h1>
        </div>
        <div id="nav-buttons" class="flex space-x-4 mr-4">
            <button id="button-view-inv" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition active">View inventory</button>
            <button id="button-add-item" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-7700 transition">Add Item</button>
        </div>
    </nav>

    <!--to be styled-->
    <div id="inventory-table-div" class="hidden">
        <h1>Inventory table</h1>
        <!--Well change the inner html of this with php-->
    </div>

    <!--to be styled-->
    <div id="add-item-form-div" class="max-w-lg rounded-xl overflow-hidden shadow-lg bg-white m-auto mt-12 p-6">
        <h1 class="text-xl font-semibold text-center">Add Item</h1>
        <form action="add-item.php" method="get">
            <label for="item-name" class="font-medium">Item Name: </label><br>
            <input type="text" name="item-name" class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"><br>
            <label for="item-category" class="font-medium">Category: </label><br>
            <select name="item-category" class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                <option value="Frozen_Dessert" class="checked:bg-blue-500 checked:text-white">Frozen Dessert</option>
                <option value="Cold_Dessert">Cold Dessert</option>
                <option value="Hot_Dessert">Hot Dessert</option>
                <option value="Room_Temperature_Dessert">Room Temperature Dessert</option>
                <option value="Bite-sized_Dessert">Bite-sized Dessert</option>
            </select><br>
            <label for="item-description" class="font-medium">Description</label><br>
            <textarea
            name="item-description"
            rows="4" cols="50"
            class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"
            placeholder="Enter a description of the item..."></textarea><br>
            <div id="item-prices" class="flex space-x-4">
                <div>
                    <label for="item-sell-price" class="font-medium">Selling Price: </label>
                    <input type="number" name="item-sell-price" step="0.01" class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"><br>
                </div>
                <div>
                    <label for="item-cost-price" class="font-medium">Cost Price: </label>
                    <input type="number" name="item-cost-price" step="0.01" class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"><br>
                </div>
            </div>
            <label for="item-quantity" class="font-medium">Quantity: </label>
            <input type="number" name="item-quantity" class="w-full my-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"><br>
            <div class="flex justify-center">
                <input type="submit" value="Add Item" class="w-full font-medium mt-2 px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            </div>
        </form>
    </div>
</body>
<script src="index.js"></script>
</html>