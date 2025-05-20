<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "dessert_inventory";

$table = "restock_history";
$tableName = strtoupper(str_replace("_", " ", $table));

$conn = new mysqli($host, $username, $password, $dbname,3306);
if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

$limit = 15;
$page = isset($_GET['page']) ? $_GET['page'] : 1 ;
$offset = ($page -1) * $limit;

$sql = "SELECT * FROM $table ORDER BY restock_id DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
if($result->num_rows > 0){
    //Div header
    echo "<h1 class='text-xl font-semibold text-center'>$tableName</h1>";
    //Table Header Row
    echo "<div class='border border-purple-300 rounded-lg overflow-hidden mt-1'>
    </table class='border-collapse w-full text-left'>
        <thead class='bg-purple-300 text-yellow-900'>
            <tr>
                <th class='font-semibold py-1.5 px-1'>Date</th>
                <th class='font-semibold py-1.5 px-1'>Time</th>
                <th class='font-semibold py-1.5 px-1'>Item</th>
                <th class='font-semibold py-1.5 px-1'>Old Qty</th>
                <th class='font-semibold py-1.5 px-1'>Added Qty</th>
                <th class='font-semibold py-1.5 px-1'>New Qty</th>
                <th class='font-semibold py-1.5 px-1'>Updated By</th>
            </tr>
        </thead>";
    //Table Data Rows
    echo "";
    //Closing Tags
    echo "</table></div>";
} else {
    echo "0 Results found.";
}
?>