<?php
  // Setting API Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Products.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect_database();

    // Instantiate Product object
  $product = new Product($db);

    // Get ID
  $product->product_id = isset($_GET['product_id']) ? $_GET['product_id'] : die();

    // Get a single Product
  $product->read_single();

    // Create array
  $product_arr = array(
      'product_id' => $product->product_id,
      'prodcut_name' => $product->product_name,
      'price' => $product->price,
      'product_size' => $product->product_size,
      'category_id' => $product->category_id,
      'category_name' => $product->category_name
  );

    // Output the content in a ja
  print_r(json_encode($product_arr));
