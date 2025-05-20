<?php
require 'db.php';
$tableName = strtoupper(str_replace("_", " ", $table));
$totalResults = $conn->query("SELECT COUNT(*) AS total FROM $table")->fetch_assoc()['total'];
$totalPages = ceil($totalResults / 10);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory | <?php echo $tableName; ?></title>
    <link rel="stylesheet" href="dist/styles.css">
    <link rel="stylesheet" href="dist/hoverStyle.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
</head>
<body class="font-['Maven_Pro'] bg-yellow-100">
    <nav class="bg-purple-300 p-2 shadow-md flex items-center justify-between px-8 mt">
        <div id="nav-header">
            <h1 class="text-3xl font-black text-yellow-900" style="--i:0.5;">Dessert Inventory</h1>
        </div>
        <div id="nav-buttons" class="flex space-x-4 mr-4">
            <a><button id="button-view-inv" style="--i:0.5;">⌕ View Inventory</button></a>
            <a><button id="button-view-history" style="--i:1.5;">Restock History</button></a>
            <a><button id="button-add-item" style="--i:2.5;">+ Add Item</button></a>
        </div>
    </nav>

    <div id="inventory-table-div" class="max-w-full% rounded-xl overflow-hidden m-auto shadow-lg bg-yellow-50 mx-6 my-6 p-2">
        <?php include 'read-database.php'; ?>
        <!-- Pagination -->
        <div  class="pagination text-center mt-2 animate-fade-in">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" 
                class="px-3 py-1 rounded-lg overflow-hidden m-0.5  transition-colors <?= ($page == $i) ? 'bg-purple-300 text-white' : 'bg-gray-200 hover:bg-gray-300' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>

    <div id="history-table-div" class=" max-w-full% rounded-xl overflow-hidden m-auto shadow-lg bg-yellow-50 mx-6 my-6 p-2">
        <?php include 'read-history-database.php'; ?>
    </div>

    <div id="add-item-form-div" class="hidden max-w-lg rounded-xl overflow-hidden shadow-lg bg-yellow-50 m-auto my-6">
        <form id="add-item-form" action="add-item.php" method="post" enctype="multipart/form-data">
            <img id="image-preview" src="./image/placeholder.jpg" alt="Uploaded image preview" class="w-full max-h-50 object-cover border border-yellow-900 rounded-xl">
            <div class="p-6 pt-0 mt-2.5">
                <div class="flex justify-center">
                    <label for="item-image-input" id="upload" class="flex justify-center w-50 px-4 py-2 text-yellow-900 rounded-md cursor-pointer hover:bg-gray-300">Upload your image</label>
                    <input type="file" name="item-image-input" id="item-image-input" style="display: none;" accept="image/*"><br>
                </div>
                <label for="item-name" class="font-medium">Item Name: </label><br>
                <input type="text" name="item-name" class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200"><br>
                <label for="item-category" class="font-medium">Category: </label><br>
                <select name="item-category" class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200">
                    <option value="Frozen_Dessert">Frozen Dessert</option>
                    <option value="Cold_Dessert">Cold Dessert</option>
                    <option value="Hot_Dessert">Hot Dessert</option>
                    <option value="Room_Temperature_Dessert">Room Temperature Dessert</option>
                    <option value="Bite-sized_Dessert">Bite-sized Dessert</option>
                </select><br>
                <label for="item-description" class="font-medium">Description</label><br>
                <textarea
                name="item-description"
                rows="4" cols="50"
                class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200"
                placeholder="Enter a description of the item..."></textarea><br>
                <div id="item-prices" class="flex space-x-4">
                    <div>
                        <label for="item-sell-price" class="font-medium">Selling Price: </label>
                        <input type="number" name="item-sell-price" step="0.01" min="0.00" class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200"><br>
                    </div>
                    <div>
                        <label for="item-cost-price" class="font-medium">Cost Price: </label>
                        <input type="number" name="item-cost-price" step="0.01" min="0.00" class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200"><br>
                    </div>
                </div>
                <label for="item-quantity" class="font-medium">Quantity: </label>
                <input type="number" name="item-quantity" step="1" min="0" class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200"><br>
                <div class="flex justify-center">
                    <input type="submit" value="Add Item" id="submitAdd" class="w-full cursor-pointer font-medium mt-2 px-6 py-2 bg-yellow-100 text-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    const buttonViewInv = document.getElementById("button-view-inv");
    const buttonAddItem = document.getElementById("button-add-item");
    const buttonViewHistory = document.getElementById("button-view-history");
    const inventoryTableDiv = document.getElementById("inventory-table-div");
    const addItemFormDiv = document.getElementById("add-item-form-div");
    const historyTableDiv = document.getElementById("history-table-div");
    const addItemForm = document.getElementById("add-item-form");

    //Nav-button functionality
    function showElement(toShow, toHide1, toHide2){
        toShow.classList.remove("hidden");
        toHide1.classList.add("hidden");
        toHide2.classList.add("hidden");
    }
    buttonViewInv.addEventListener('click', () => {
        showElement(inventoryTableDiv, addItemFormDiv, historyTableDiv);
        document.title = "Inventory | <?php echo $tableName; ?>";
    })
    buttonViewHistory.addEventListener('click', () => {
        showElement(historyTableDiv, addItemFormDiv, inventoryTableDiv);
        document.title = "Restock History | <?php echo $tableName ?>";
    })
    buttonAddItem.addEventListener('click', () => {
        showElement(addItemFormDiv, inventoryTableDiv, historyTableDiv);
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

    //image-upload
    const imageInput = document.getElementById('item-image-input');
    imageInput.addEventListener('change', function(event) {
    const label = document.querySelector('label[for="item-image-input"]');
    if (this.files && this.files[0]) {
        label.textContent = `Change file`;
    } else {
        label.textContent = 'Upload your image';
    }
    });

    //image preview
    const imagePreview = document.getElementById('image-preview');
    imageInput.addEventListener("change", (event) => {
        event.preventDefault();
        const file = event.target.files[0];
        if (file){
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove("hidden", "border", "border-gray-300", "rounded-xl");

            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = "./image/placeholder.jpg";
            imagePreview.classList.add("hidden", "border", "border-gray-300", "rounded-xl");
        }
    })
</script>
</html>