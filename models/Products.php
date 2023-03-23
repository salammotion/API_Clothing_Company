<?php
/**
 * Class of Products containing different database modelling for products
 */
class Product {
    /**
     * To declare database connection variable
     *
     * @var --
     */
    private $conn;
    /**
     * To specify the database table to work with
     *
     * @var string
     */
    private $table = "products";

    //Product properties
    public $product_id;
    public $product_name;
    public $price;
    public $product_size;
    public $category_name;
    public $category_id;
    public $created_at;
    /**
     * To instantiate a product object with database connection
     *
     * @param [type] $db
     */
    //To create a constructor that creates a new product by passing the database object
    public function __construct($db) {
        $this->conn = $db;
    }
    /**
     * Function to read all the product data from the database
     *
     * 
     */
    
    //Method to get/read all products
    public function read() {
        $query = 'SELECT product_id, product_name, price, product_size, category_name, category_id, created_at FROM ' 
        . $this->table . ' ORDER BY created_at DESC';

        //Creating the prepared statement
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    /**
     * Function to read single product from the database
     *
     * @return void
     */

    // Get Single Product
    public function read_single() {
        // Create query
        $query = 'SELECT product_id, product_name, price, product_size, category_name, category_id, created_at FROM ' . $this->table . ' WHERE product_id = ? LIMIT 0,1';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Bind PRODUCT_ID
        $stmt->bindParam(1, $this->product_id);
        // Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Set properties
        $this->product_id = $row['product_id'];
        $this->product_name = $row['product_name'];
        $this->price = $row['price'];
        $this->product_size = $row['product_size'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }
}