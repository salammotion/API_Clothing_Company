<?php 
  // Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Orders.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect_database();
  // Instantiate customer object
$order = new Orders($db);
  // Get ID
$order->order_id = isset($_GET['order_id']) ? $_GET['order_id'] : die();
  // Get order
$order->read_single();
  // Create order array
$order_array = array(
    'order_id' => $order_id,
    'customer_id' => $customer_id,
    'product_id' => $product_id,
    'order_status' => $order_status,
);

  // Make JSON
print_r(json_encode($order_array));
