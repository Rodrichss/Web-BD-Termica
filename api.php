<?php

require('con.php');

// Set header to return JSON
header('Content-Type: application/json');

// Check if it's a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Perform your SQL query
    $result = mysqli_query($con, "SELECT * FROM producto");
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Return the data as JSON
    echo json_encode($products);
} else {
    // Handle other request types or return an error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method Not Allowed']);
}

?>