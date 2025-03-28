<?php 
include 'db.php';
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory | <?php echo $tableName; ?></title>
    <link rel="stylesheet" href="dist/styles.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-white p-2 shadow-md flex items-center justify-between px-8 mt">
        <div id="nav-header">
            <h1 class="text-3xl font-bold text-blue-500">Dessert Inventory</h1>
        </div>
        <div id="nav-buttons" class="flex space-x-4 mr-4">
            <a><button id="button-view-inv" class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition active">View inventory</button></a>
            <a><button id="button-add-item" class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Add Item</button></a>
        </div>
    </nav>

    <div id="inventory-table-div" class="max-w-full% rounded-xl overflow-hidden m-auto shadow-lg bg-white mx-6 mt-6 p-2">
        <?php include 'read-database.php'; ?>
    </div>

    <div id="add-item-form-div" class="hidden max-w-lg rounded-xl overflow-hidden shadow-lg bg-white m-auto mt-6 p-6">
        <h1 class="text-xl font-semibold text-center">Add Item</h1>
        <form id="add-item-form" action="add-item.php" method="post">
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
                <input type="submit" value="Add Item" class="w-full cursor-pointer font-medium mt-2 px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            </div>
        </form>
    </div>
</body>
<script>
    const buttonViewInv = document.getElementById("button-view-inv");
    const buttonAddItem = document.getElementById("button-add-item");
    const inventoryTableDiv = document.getElementById("inventory-table-div");
    const addItemFormDiv = document.getElementById("add-item-form-div");
    const addItemForm = document.getElementById("add-item-form");

    //Nav-button functionality
    function showElement(toShow, toHide){
        toShow.classList.remove("hidden");
        toHide.classList.add("hidden");
    }
    buttonViewInv.addEventListener('click', () => {
        showElement(inventoryTableDiv, addItemFormDiv);
        document.title = "Inventory | <?php echo $tableName; ?>";
    })
    buttonAddItem.addEventListener('click', () => {
        showElement(addItemFormDiv, inventoryTableDiv);
        document.title = "Add Item | <?php echo $tableName; ?>";
    })

    //toggling description length in table
    document.addEventListener("DOMContentLoaded", () => {
        const expandLinks = document.querySelectorAll(".expand-link");
        const collapseLinks = document.querySelectorAll(".collapse-link");

        expandLinks.forEach(link => {
            link.addEventListener("click", (event) => {
                event.preventDefault();
                const container = event.target.closest(".description-container");
                showElement(container.querySelector(".full-description"), container.querySelector(".short-description"));
            });
        });
        
        collapseLinks.forEach(link => {
            link.addEventListener("click", (event) => {
                event.preventDefault();
                const container = event.target.closest(".description-container");
                showElement(container.querySelector(".short-description"), container.querySelector(".full-description"));
            });
        });
    });

    //Alerting successful item add
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');
    if (message) {
        setTimeout(() => {
            alert(message);
        }, 100);
        history.replaceState({}, '', window.location.pathname);
    }

    //redirecting back to this page from delete-item.php
    document.addEventListener("DOMContentLoaded", ()=> {
        const hash = window.location.hash;
        if(hash === '#inventory-table-div'){
            showElement(inventoryTableDiv, addItemFormDiv);
        } else if (hash === '#add-item-form-div') {
            showElement(addItemFormDiv, inventoryTableDiv);
        }
        history.replaceState({}, '', window.location.pathname);
    })
</script>
</html>