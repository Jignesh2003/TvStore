<?php

require_once(__DIR__ . "/Auth.php");

class Products
{

    private $conn;

    /**
     * Initializes the Products class.
     *
     * This constructor establishes a connection to the database 
     * when the Products class is instantiated.
     */
    public function __construct()
    {
        // Create the connection once when initializing the class
        $auth = new Authentication();
        $this->conn = $auth->dataBase(); // Store the connection for future use
    }

    /**
     * Retrieves all products from the database.
     *
     * This function prepares and executes a SQL query to fetch 
     * all products from the 'products' table. It then returns 
     * the results as an associative array.
     *
     * @return array Returns an associative array of all products from the database.
     */
    public function getProductsAll()
    {
        // Prepare the SQL query
        $stmt = $this->conn->prepare("SELECT * FROM `products`;");

        // Execute the query
        $stmt->execute();

        // Fetch the result of the query
        $result = $stmt->get_result();

        // Close the connection after executing the query
        $this->conn->close();

        // Return the results as an associative array
        return $result->fetch_all(MYSQLI_ASSOC); // Use fetch_all to retrieve all rows
    }

    public function getProducts($id = null, $name = null)
    {
        // Check if both $id and $name are null
        if ($id === null && $name === null) {
            return "The function must have at least one of these values: \$id or \$name";
        }

        // Start with a base query
        $query = "SELECT * FROM `products` WHERE 1=1"; // Using 1=1 to simplify adding conditions
        $params = [];
        $types = '';

        // Check if $id is provided
        if ($id !== null) {
            $query .= " AND id = ?";
            $params[] = $id;
            $types .= 'i'; // 'i' for integer
        }

        // Check if $name is provided
        if ($name !== null) {
            $query .= " AND name = ?";
            $params[] = $name;
            $types .= 's'; // 's' for string
        }

        // Prepare the SQL query
        $stmt = $this->conn->prepare($query);

        // Bind the parameters dynamically
        if ($params) {
            $stmt->bind_param($types, ...$params); // Use the spread operator to unpack the array
        }

        // Execute the query
        $stmt->execute();

        // Fetch the result of the query
        $result = $stmt->get_result();

        // Close the connection after executing the query
        $this->conn->close();

        // Return the results as an associative array
        return $result->fetch_assoc();
    }
}
