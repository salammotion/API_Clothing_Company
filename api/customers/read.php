<?php

//Setting the headers
header("Access-Control-Allow_Origin: *");
header("Content-Type: application/json");

include_once '../../config/Database.php';
include_once '../../models/Customers.php';

// To instantiate and connect to database
$database = new Database();
$db = $database->connect_database();

// Instantiate Product object
$customer = new Customers($db);

// Product query
$result = $customer->read();
$count = $result->rowCount();
    
// Check if there are any products
if ($count > 0) {
    $customer_array = array();
    $customer_array["data"] = array();

    //To loop through the product data
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $customer_item = array(
            "customer_id"=> $customer_id,
            "customer_name"=> $customer_name,
            "username" => $username,
            "address" => $address,
        );

        //Add the $customer_item array to the customer_array
        array_push($customer_array["data"], $customer_item);
    }
    //Convert the data to JSON and output it.
    echo json_encode($customer_array);
} else {
    // If no customer found
    echo json_encode(
        array("Message" => "No Customer Found")
        );
}
