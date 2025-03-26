<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crem de la Crem | Inventory</title>
    <link rel="stylesheet" href="dist/styles.css">
</head>
<body>
    <nav class="bg-amber-100 p-2 shadow-md flex items-center justify-between px-8 mt">
        <div id="nav-header">
            <h1 class="text-3xl font-bold text-amber-700">Dessert Inventory</h1>
        </div>
        <div id="nav-buttons" class="flex space-x-4 mr-4">
            <button id="button-view-inv" class="bg-amber-700 text-amber-100 px-4 py-2 rounded hover:bg-amber-800 transition active">View inventory</button>
            <button id="button-add-item" class="bg-amber-700 text-amber-100 px-4 py-2 rounded hover:bg-amber-800 transition">Add Item</button>
        </div>
    </nav>

    <!--to be styled-->
    <div id="inventory-table-div" class="">
        <h1>Inventory table</h1>
        <!--Well change the inner html of this with php-->
    </div>

    <!--to be styled-->
    <div id="add-item-form-div" class="hidden">
        <h1>Add Item</h1>
        <form action="add-item-process.php" method="get">
            <label for="item-name">Item Name: </label>
            <input type="text" name="item-name"><br>
            <label for="item-category">Category: </label>
            <select name="item-category">
                <option value="Frozen_Dessert">Frozen Dessert</option>
                <option value="Cold_Dessert">Cold Dessert</option>
                <option value="Hot_Dessert">Hot Dessert</option>
                <option value="Room_Temperature_Dessert">Room Temperature Dessert</option>
                <option value="Bite-sized_Dessert">Bite-sized Dessert</option>
            </select><br>
            <label for="item-description">Description</label><br>
            <textarea
            name="item-description"
            rows="4" cols="60"
            placeholder="Enter a description of the item...">
            </textarea><br>
            <label for="item-sell-price">Selling Price: </label>
            <input type="number" name="item-sell-price" step="0.01"><br>
            <label for="item-cost-price">Cost Price: </label>
            <input type="number" name="item-cost-price" step="0.01"><br>
            <label for="item-quantity">Quantity: </label>
            <input type="number" name="item-quantity"><br>
            <input type="submit" value="Add Item">
        </form>
    </div>
</body>
<script src="index.js"></script>
</html>