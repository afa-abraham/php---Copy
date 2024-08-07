<?php 
require base_path('db/config.php');

$sql = "SELECT * from clients where id = ?";

$stmt = $conn->prepare($sql);
if(!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$id = $_GET['id'];
$stmt->bind_param("i",$id);
// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if a record was found
if ($result->num_rows === 0) {
    die("No record found.");
}

// Fetch the result
$client = $result->fetch_assoc();

view('clients/show.view.php',[
    'client' => $client
]);


// Clean up
$stmt->close();
$conn->close();