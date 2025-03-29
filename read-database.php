<?php
require 'db.php';

$sql = "SELECT * FROM $table";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    echo "<h1 class='text-xl font-semibold text-center'>$tableName</h1>
    <div class='border border-blue-500 rounded-lg overflow-hidden mt-1'>
    <table class='border-collapse w-full text-left'>
        <thead class='bg-blue-500 text-white'>
            <tr>
                <th class='font-semibold py-1.5 px-1 pl-3 w-10'>ID</th>
                <th class='font-semibold py-1.5 px-1 w-50'>Name</th>
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
    while ($row = $result->fetch_assoc()){
        //fixing category
        $category = str_replace("_", " ", $row["category"]);

        //long and short description
        $shortDesc = strlen($row["description"]) > 60 ? substr($row["description"], 0, 60) : $row["description"];
        $row["description"] = !empty($row["description"]) ? $row["description"] : "No description available.";
        
        //pricing
        $row['cost_price'] = number_format(floatval($row['cost_price']), 2);
        $row['sell_price'] = number_format(floatval($row['sell_price']), 2);

        //alternating gray background
        echo ($rowCnt%2==0) ? "<tr class='bg-gray-100'>" : "<tr class='bg-white'>" ;
        $rowCnt++;

        echo "<td class='text-center'>" . $row["id"] . "</td>
            <td class='pl-1'>" . $row["name"] . "</td>
            <td>" . $category . "</td>
            <td class='text-justify py-1.5 pr-4'>
                <div class='description-container'>";

                if (strlen($row["description"]) > 60) {
                    echo "<span class='short-description'>
                        " . htmlspecialchars($shortDesc) . "
                        <a href='#' class='expand-link text-blue-500'>[...]</a>
                    </span>
                    <span class='full-description hidden'>
                        " . htmlspecialchars($row["description"]) . " 
                        <a href='#' class='collapse-link text-blue-500'>[Hide]</a>
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
} else {
    echo "0 results found.";
}

$conn->close();
?>