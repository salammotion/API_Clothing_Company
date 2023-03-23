<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Customers.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect_database();
// Instantiate customer object
$customer = new Customers($db);
// Get ID
$customer->customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] : die();
// Get customer
$customer->read_single();
// Create array
$customer_array = array(
  'customer_id' => $customer_id,
  'customer_name' => $customer_name,
  'username' => $username,
  'address' => $address,
);

// Make JSON
print_r(json_encode($customer_array));
