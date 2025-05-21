<?php
require 'db.php';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$threshold = isset($_GET['threshold']) ? intval($_GET['threshold']) : 10; // Default threshold is 10

$limit = 15;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fix the ORDER BY clause construction to prevent SQL injection
switch ($sort) {
    case 'in_stock_true':
        $orderBy = "is_available DESC, id ASC";
        break;
    case 'in_stock_false':
        $orderBy = "is_available ASC, id ASC";
        break;
    case 'low_stock':
        $orderBy = "CASE 
                    WHEN quantity = 0 THEN 0
                    WHEN quantity <= $threshold/2 THEN 1
                    WHEN quantity <= $threshold THEN 2
                    ELSE 3 END, id ASC";
        break;
    case 'id':
    default:
        $orderBy = "id ASC";
        break;
}

// Removed the WHERE active = 1 condition since the column doesn't exist
$sql = "SELECT * FROM $table ORDER BY $orderBy LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        echo "
<div class='flex justify-between items-center mb-2'>
    <form method='get' class='mr-2'>
        <label for='sort' class='mr-2'>Sort by:</label>
        <select name='sort' id='sort' class='border rounded px-2 py-1'>
            <option value='id'" . ($sort == 'id' ? " selected" : "") . ">ID</option>
            <option value='in_stock_true'" . ($sort == 'in_stock_true' ? " selected" : "") . ">In Stock (True)</option>
            <option value='in_stock_false'" . ($sort == 'in_stock_false' ? " selected" : "") . ">In Stock (False)</option>
            <option value='low_stock'" . ($sort == 'low_stock' ? " selected" : "") . ">Low Stock First</option>
        </select>
        <label for='threshold' class='ml-4 mr-2'>Stock Threshold:</label>
        <input type='number' name='threshold' id='threshold' min='1' value='$threshold' class='border rounded px-2 py-1 w-16'>
        <button type='submit' class='bg-purple-500 text-white px-3 py-1 rounded ml-2'>Apply</button>
    </form>
</div>";
        echo "<h1 class='text-xl font-semibold text-center'>$tableName</h1>
        <div class='border border-purple-300 rounded-lg overflow-hidden mt-1'>
        <table class='border-collapse w-full text-left'>
            <thead class='bg-purple-300 text-yellow-900'>
                <tr>
                    <th class='font-semibold py-1.5 px-1 pl-3 w-10'>ID</th>
                    <th class='font-semibold py-1.5 px-1 w-40'>Name</th>
                    <th class='font-semibold py-1.5 px-1 w-40'>Category</th>
                    <th class='font-semibold py-1.5 px-1'>Description</th>"
                     . //<th class='font-semibold py-1.5 px-1'>Image Path</th>
                    "<th class='font-semibold py-1.5 px-1 text-center w-30'>Last Restocked</th>
                    <th class='font-semibold py-1.5 px-1 text-center w-17'>In Stock</th>
                    <th class='font-semibold py-1.5 px-1 text-center w-20'>Sale</th>
                    <th class='font-semibold py-1.5 px-1 text-center w-20'>Cost</th>
                    <th class='font-semibold py-1.5 px-1 text-center w-13'>Stock</th>
                    <th class='font-semibold py-1.5 px-1 w-8'></th>
                    <th class='font-semibold py-1.5 px-1 w-7'></th>
                </tr>
            </thead>";

        $rowCnt = 0;
        while ($row = $result->fetch_assoc()) {
            //fixing category
            $category = str_replace("_", " ", $row["category"]);

            //long and short description
            $shortDesc = strlen($row["description"]) > 58 ? substr($row["description"], 0, 58) : $row["description"];
            $row["description"] = !empty($row["description"]) ? $row["description"] : "No description available.";
            
            //pricing
            $row['cost_price'] = number_format(floatval($row['cost_price']), 2);
            $row['sell_price'] = number_format(floatval($row['sell_price']), 2);

            // Determine stock status and row color
            $quantity = intval($row["quantity"]);
            $stockClass = '';
            if ($quantity == 0) {
                $stockClass = 'bg-red-200'; // Out of stock
            } elseif ($quantity <= $threshold/2) {
                $stockClass = 'bg-orange-200'; // Critical stock
            } elseif ($quantity <= $threshold) {
                $stockClass = 'bg-yellow-200'; // Low stock
            } else {
                $stockClass = ($rowCnt%2==0) ? 'bg-gray-100' : 'bg-white'; // Normal stock with alternating colors
            }
            $rowCnt++;

            //outputting row data
            echo "<tr class='$stockClass'>";
            echo "<td class='text-center'>" . $row["id"] . "</td>
                <td class='pl-1'>" . $row["name"] . "</td>
                <td>" . $category . "</td>
                <td class='text-justify py-1.5 pr-4'>
                    <div class='description-container'>";

                    if (strlen($row["description"]) >58) {
                        echo "<span class='short-description'>
                            " . htmlspecialchars($shortDesc) . "
                            <a href='#' class='expand-link text-purple-500'>show more⧨</a>
                        </span>
                        <span class='full-description hidden'>
                            " . htmlspecialchars($row["description"]) . " 
                            <a href='#' class='collapse-link text-purple-500'>hide◭</a>
                        </span>"; 
                    } else {
                        echo $row["description"];
                    }

            echo    "</div>
                </td>"
                 . //<td>" . $row["image_path"] . "</td>
                "<td class='text-center'>" . $row["last_restocked"] . "</td>
                <td class='text-center'>" . ($row["is_available"] ? "TRUE" : "FALSE") . "</td>
                <td class='text-right pr-2'>₱" . $row["sell_price"] . "</td>
                <td class='text-right pr-2'>₱" . $row["cost_price"] . "</td>
                <td class='text-right pr-2'>" . $row["quantity"] . "</td>
                <td class='p-1'>
                    <a href='edit-item-form.php?id=" . $row['id'] . "'>
                        <img src='src/edit.png' alt='edit' width='18px'>
                    </a>
                </td>
                <td>
                    <a href='delete-item-form.php?id=" . $row['id'] . "'>
                        <img src='src/delete.png' alt='delete' width='18px'>
                    </a>
                </td>
            </tr>";
        }
        echo "</table></div>";

        // Add legend
        echo "
        <div class='mt-4 border border-gray-300 rounded p-3 bg-gray-50'>
            <h3 class='font-semibold mb-2'>Stock Level Legend:</h3>
            <div class='flex flex-wrap'>
                <div class='flex items-center mr-6'>
                    <div class='w-4 h-4 bg-red-200 mr-2'></div>
                    <span>Out of Stock (0 items)</span>
                </div>
                <div class='flex items-center mr-6'>
                    <div class='w-4 h-4 bg-orange-200 mr-2'></div>
                    <span>Critical Stock (1-" . floor($threshold/2) . " items)</span>
                </div>
                <div class='flex items-center mr-6'>
                    <div class='w-4 h-4 bg-yellow-200 mr-2'></div>
                    <span>Low Stock (" . (floor($threshold/2) + 1) . "-$threshold items)</span>
                </div>
                <div class='flex items-center'>
                    <div class='w-4 h-4 bg-white border border-gray-300 mr-2'></div>
                    <span>Normal Stock (>" . $threshold . " items)</span>
                </div>
            </div>
        </div>";
        
        // Add script for expanding/collapsing descriptions
        echo "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.expand-link').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    let container = this.closest('.description-container');
                    container.querySelector('.short-description').classList.add('hidden');
                    container.querySelector('.full-description').classList.remove('hidden');
                });
            });
            
            document.querySelectorAll('.collapse-link').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    let container = this.closest('.description-container');
                    container.querySelector('.full-description').classList.add('hidden');
                    container.querySelector('.short-description').classList.remove('hidden');
                });
            });
        });
        </script>";
    } else {
        echo "Error executing query: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
?>