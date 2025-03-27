<?php
//for image_path, get the name string and remove spaces
//then concatenate with `/image/-` and `-.jpg`

//for last_restocked, make it the date when the GET request was made

//for is_available, the sql table's default is 1
//idk if we still need to make it 1 here tho

$name = $_GET["item-name"];
$category = $_GET["item-category"];
$description = $_GET["item-description"];
$sellPrice = $_GET["item-sell-price"];
$costPrice = $_GET["item-cost-price"];
$quantity = $_GET["item-quantity"];
?>