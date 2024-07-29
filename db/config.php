<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "m5";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Execute the query
$result = $conn->query('SELECT * FROM users');

// Check if the query was successful
if ($result) {
    // Fetch all rows as an associative array
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Handle query error
    echo "Query Error: " . $conn->error;
}

// Free result set
$result->free();