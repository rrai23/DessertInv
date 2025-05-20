<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "dessert_inventory";

$restockTable = "restock_history";
$productTable = "crem_de_la_crem";
$tableName = strtoupper(str_replace("_", " ", $restockTable));

$conn = new mysqli($host, $username, $password, $dbname,3306);
if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

$limit = 20;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1 ;
$offset = ($page -1) * $limit;

$sql = "SELECT
        rt.restock_id,
        rt.item_id,
        pt.name AS item_name,
        pt.category AS category,
        rt.datetime,
        rt.old_quantity,
        rt.quantity_added,
        rt.new_quantity,
        rt.updated_by
    FROM $restockTable rt
    JOIN $productTable pt ON rt.item_id = pt.id
    ORDER BY rt.restock_id DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
if($result->num_rows > 0){
    //Div header
    echo "<h1 class='text-xl font-semibold text-center'>$tableName</h1>";
    //Table Header Row
    echo "<div class='border border-purple-300 rounded-lg overflow-hidden mt-1'>
    <table class='border-collapse w-full text-left'>
        <thead class='bg-purple-300 text-yellow-900'>
            <tr>
                <th class='font-semibold py-1.5 px-1 pl-4 w-12'>ID</th>
                <th class='font-semibold text-center py-1.5 px-1 pl-4 w-28'>Date</th>
                <th class='font-semibold text-center py-1.5 px-1 pl-8 w-28'>Time</th>
                <th class='font-semibold py-1.5 pl-9 pr-1 w-72'>Item</th>
                <th class='font-semibold py-1.5 pr-1 w-200'>Category</th>
                <th class='font-semibold text-right py-1.5 pl-1 w-20'>Old Qty</th>
                <th class='font-semibold text-right py-1.5 pl-4 w-20'>+Qty</th>
                <th class='font-semibold text-right py-1.5 pl-1 w-20'>New Qty</th>
                <th class='font-semibold text-center py-1.5 px-1 w-52'>Updated By</th>
                <th class='font-semibold py-1.5 pr-6 w-10'>View</th>
            </tr>
        </thead>
        <tbody>";
    //Table Data Rows
    $rowCnt = 0;
    while($row = $result->fetch_assoc()){
        //fix date and time
        $dateTime = new DateTime($row['datetime']);
        $date = $dateTime->format('m-d-Y');
        $time = $dateTime->format('g:i A');

        //alternating gray background
        echo ($rowCnt%2==0) ? "<tr class='bg-gray-100'>" : "<tr class='bg-white'>" ;
        $rowCnt++;

        //outputting row data
        echo "<td class='text-center'>" . $row['restock_id'] . "</td>";
        echo "<td class='text-center pl-4'>" . $date . "</td>";
        echo "<td class='text-center pl-8'>" . $time . "</td>";
        echo "<td class='pl-9'>" . $row['item_name'] . "</td>";
        echo "<td class=''>" . $row['category'] . "</td>";
        echo "<td class='text-right pr-2'>" . $row['old_quantity'] . "</td>";
        echo "<td class='text-right pr-2'>" . $row['quantity_added'] . "</td>";
        echo "<td class='text-right pr-2'>" . $row['new_quantity'] . "</td>";
        echo "<td class='text-center'>" . $row['updated_by'] . "</td>";
        echo "<td class='pl-3'>
                <a href='edit-item-form.php?id=" . $row['item_id'] . "'>
                    <img src='src/view.png' alt='view' width='18px'>
                </a>
            </td>";
        echo "</tr>";
    }
    //Closing Tags
    echo "</tbody></table></div>";
} else {
    echo "0 Results found.";
}
?>