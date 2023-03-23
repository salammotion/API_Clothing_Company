<?php
//Setting the headers

header("Access-Control-Allow_Origin: *");
header("Content-Type: application/json");

include_once '../../config/Database.php';
include_once '../../models/Products.php';

// To instantiate and connect to database
$database = new Database();
$db = $database->connect_database();

// Instantiate Product object
$product = new Product($db);

// Product query
$result = $product->read();
$count = $result->rowCount();
    
// Check if there are any products
if ($count > 0) {
    $product_array = array();
    $product_array["data"] = array();

    //To loop through the product data
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product_item = array(
            "product_id" => $product_id,
            "product_name"=> $product_name,
            "price" => $price,
            "product_size"=> $product_size,
            "category_name" => $category_name,
            "category_id" => $category_id
        );

        //Add the product_item array to the product_array
        array_push($product_array["data"], $product_item);
    }
    //Convert the data to JSON and output it.
    echo json_encode($product_array);
} else {
    // If no product found
    echo json_encode(
        array("Message" => "No Product Found")
        );
}



