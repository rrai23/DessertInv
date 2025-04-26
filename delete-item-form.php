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
    $filePath = __DIR__ . $imagePath;
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
    <title>Delete Item | <?php echo $tableName; ?></title>
    <link rel="stylesheet" href="dist/styles.css">
    <link rel="stylesheet" href="dist/hoverStyle.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
</head>
<body class="font-['Maven_Pro'] bg-yellow-100">
    <nav class="bg-purple-300 p-2 shadow-md flex items-center justify-between px-8 mt">
        <div id="nav-header">
            <h1 class="text-3xl font-bold text-yellow-900">Dessert Inventory</h1>
        </div>
        <div id="nav-buttons" class="flex space-x-4 mr-4">
            <a href='index.php#inventory-table-div'><button id="button-view-inv">⌕ View inventory</button></a>
            <a href='index.php#add-item-form-div'><button id="button-add-item">+ Add Item</button></a>
        </div>
    </nav>

    <div id="item-info-div" class="max-w-lg rounded-xl bg-yellow-50 shadow-lg overflow-hidden mx-auto mt-6 mb-6">
        <img src="<?php echo $imagePath ?>" alt="selected item image" class="w-full max-h-50 object-cover">
        <div class="item-info pb-4 px-6">
            <h1 class="text-xl font-semibold text-center mt-2 text-yellow-900"><?php echo $name; ?></h1>
            <h2 class="text-sm text-center text-purple-700 mb-1"><?php echo str_replace("_", " ", $category); ?></h2>
            <p class="text-md text-justify mb-4"><?php echo $description; ?></p>
            <div id="middle-info" class="flex flex-row">
                <div id="last-restocked-info" class="w-1/3">
                    <p class="text-md text-purple-700">Last Restock:</p>
                    <h2 class="text-xl"><?php echo $lastRestocked; ?></h2>
                </div>
                <div id="id-info" class="w-1/3">
                    <p class="text-md text-purple-700">ID Number:</p>
                    <h2 class="text-xl">#<?php echo $id; ?></h2>
                </div>
                <div id="is-available-info" class="w-1/3">
                    <p class="text-md text-purple-700">Is Available:</p>
                    <h2 class="text-xl"><?php echo ($isAvailable === 1 ? "True" : "False"); ?></h2>
                </div>
            </div>
            <div id="bottom-info" class="flex flex-row items-center justify-evenly">
                <div id="cost-price-info" class="w-1/3">
                    <p class="text-md text-purple-700">Cost Price:</p>
                    <h2 class="text-xl">₱<?php echo $costPrice; ?></h2>
                </div>
                <div id="sale-price-info" class="w-1/3">
                    <p class="text-md text-purple-700">Sale Price:</p>
                    <h2 class="text-xl">₱<?php echo $sellPrice; ?></h2>
                </div>
                <div id="quantity-info" class="w-1/3">
                    <p class="text-md text-purple-700">Quantity:</p>
                    <h2 class="text-xl"><?php echo $quantity; ?> unit(s)</h2>
                </div>
            </div> 
        </div>
        <div id="item-buttons" class="max-w-full justify-between mt-4 mb-1 px-6">
            <a href="index.php"><button id="button-cancel-delete" class="w-57 cursor-pointer font-medium mt-2 px-6 py-2 bg-yellow-500 text-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Cancel</button></a>
            <a href="delete-item.php?id=<?php echo $_GET['id']; ?>"><button class="love w-57 cursor-pointer font-medium mt-2 px-6 py-2 bg-yellow-300 text-yellow-900 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Delete Item</button></a>
        </div>
        <p class="text-center text-red-500 mb-2">This action is <span class="font-semibold">PERMANENT</span></p>
    </div>
</body>
<script></script>
</html>