<?php
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
    $isAvailable = ($item["is_available"] ? TRUE : FALSE);
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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dist/styles.css">
    <link rel="stylesheet" href="dist/hoverStyle.css">
</head>
<body class="font-['Maven_Pro'] bg-yellow-100">
    <nav class="bg-purple-300 p-2 shadow-md flex items-center justify-between px-8 mt">
        <div id="nav-header">
            <h1 class="text-3xl font-bold text-yellow-900">Dessert Inventory | Edit Item</h1>
        </div>
        <div id="nav-buttons" class="flex space-x-4 mr-4">
            <a href='index.php#inventory-table-div'><button id="button-view-inv">View inventory</button></a>
            <a href='index.php#add-item-form-div'><button id="button-add-item">Add Item</button></a>
        </div>
    </nav>

    <div id="edit-item-form-div">
        <div id="item-info" class="bg-yellow-50 max-w-lg rounded-lg shadow-lg overflow-hidden mx-auto my-6">
            <form id="edit-item-form" action="edit-item.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <img id="image-preview" src="<?php echo ($imagePath) ? $imagePath: "./images/placeholder.jpg"; ?>" alt="Uploaded image preview" class="w-full max-h-50 object-cover">
                <div class="p-6 pt-0 mt-2.5">
                    <div class="flex justify-center">
                        <label for="item-image-input" id="change" class="flex justify-center w-50 px-4 py-2 bg-yellow-100 max-h-50 object-cover border border-yellow-900 rounded-xl">Change Image</label>
                        <input type="file" name="item-image-input" id="item-image-input" style="display: none;" accept="image/*"><br>
                    </div>
                    <label for="item-name" class="font-medium">Item Name: </label><br>
                    <input type="text" name="item-name" value="<?php echo $name; ?>" class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200"><br>
                    <label for="item-category" class="font-medium">Category: </label><br>
                    <select name="item-category" class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200">
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
                    class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200"
                    placeholder="Enter a description of the item..."><?php echo trim($description); ?></textarea><br>
                    <div id="item-prices" class="flex space-x-4">
                        <div>
                            <label for="item-sell-price" class="font-medium">Selling Price: </label>
                            <input type="number" name="item-sell-price" min="0.00" value="<?php echo $sellPrice; ?>" step="0.01" class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200"><br>
                        </div>
                        <div>
                            <label for="item-cost-price" class="font-medium">Cost Price: </label>
                            <input type="number" name="item-cost-price" min="0.00" value="<?php echo $costPrice; ?>" step="0.01" class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200"><br>
                        </div>
                    </div>
                    <div id="item-bottom" class="flex space-x-4">
                        <div class="w-1/3">
                            <label for="item-last-restocked" class="font-medium">Last Restocked: </label>
                            <input type="date" id="item-last-restocked" name="item-last-restocked" value="<?php echo $lastRestocked ?>" class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200">
                        </div>
                        <div class="w-1/3">
                            <label for="item-quantity" class="font-medium">Quantity: </label>
                            <input type="number" id="item-quantity" name="item-quantity" min="0" value="<?php echo $quantity; ?>" step="1" class="w-full my-1 px-3 py-2 border border-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-200"><br>
                        </div>
                        <div class="w-1/3">
                            <p class="font-medium mb-1">In Stock: </p>
                            <div id="in-stock-radio" class="flex justify-between items-center mt-3">
                                <div id="in-stock-radio-true-div" class="flex items-center space-x-2">    
                                    <input type="radio" 
                                        name="item-is-available" 
                                        id="is-available-true" 
                                        value="1" <?php echo ($isAvailable) ? "checked" : NULL; ?>
                                        class="cursor-pointer w-4 h-4 text-yellow-500 border-yellow-900">
                                    <label for="is-available-true" class="text-gray-700 font-medium cursor-pointer">TRUE</label>
                                </div>
                                <div id="in-stock-radio-false-div" class="flex items-center space-x-2">
                                    <input type="radio" 
                                        name="item-is-available" 
                                        id="is-available-false" 
                                        value="0" <?php echo (!$isAvailable) ? "checked" : NULL; ?>
                                        class="cursor-pointer w-4 h-4 text-blue-500 border-yellow-900">
                                    <label for="is-available-false" class="text-gray-700 font-medium cursor-pointer">FALSE</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-3">
                        <button id="button-cancel-delete" class="w-57 cursor-pointer font-medium mt-2 px-6 py-2 bg-yellow-500 text-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Cancel</button>
                        <input type="submit" value="Edit Item" id="edit" class="w-57 cursor-pointer font-medium mt-2 px-6 py-2 bg-yellow-300 text-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    <p class="text-center text-red-500 mt-1 mb-2">This action is <span class="font-semibold">PERMANENT</span></p>
                    <?php if (isset($_GET['error'])): ?><script>alert("<?= htmlspecialchars($_GET['error']) ?>");</script><?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
//cancel button functionality
const buttonCancel = document.getElementById("button-cancel-delete");
buttonCancel.addEventListener('click', (event) => {
    event.preventDefault();
    window.location.href = './index.php';
})

//sets max value for date to today
const today = new Date().toISOString().split('T')[0];
document.getElementById('item-last-restocked').setAttribute('max', today);

//if quantity is set to 0, isAvailable is set to false
const quantityInput = document.getElementById('item-quantity');
const isAvailableTrue = document.getElementById('is-available-true');
const isAvailableFalse = document.getElementById('is-available-false');
quantityInput.addEventListener('input', (event) => {
    event.preventDefault();
    if(parseInt(quantityInput.value, 10) === 0){
        isAvailableFalse.checked = true;
    } else {
        isAvailableTrue.checked = true;
    }
})

//image preview
const imageInput = document.getElementById('item-image-input');
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
        imagePreview.src = "<?php echo $imagePath; ?>";
        imagePreview.classList.add("hidden", "border", "border-gray-300", "rounded-xl");
    }
})
</script>
</html>