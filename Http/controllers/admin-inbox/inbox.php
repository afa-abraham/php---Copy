<?php
require base_path('db/config.php');



// Assume $message_id is the ID of the message to mark as read
$message_id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Sanitize input


// Prepare the SQL statement
$sql = "UPDATE mails SET is_read = 1 WHERE id = ?";

// Initialize a prepared statement
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

// Bind the parameter (message_id)
$stmt->bind_param('i', $message_id);

// Execute the statement
if ($stmt->execute()) {
} else {
    echo "Error: " . $stmt->error;
}



// Fetch the record with the given ID and email
$sql = "SELECT m.id, CONCAT(u.first_name, ' ', u.last_name) AS sender_name, m.body,u.email,m.created_at
        FROM mails m
        JOIN users u ON m.sender_id = u.id
        WHERE m.id = ? ";

// Prepare the statement
$stmt = $conn->prepare($sql);
// Check if the statement was prepared successfully
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$id = $_GET['id'];
$stmt->bind_param("i", $id); 
// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if a record was found
if ($result->num_rows === 0) {
    die("No record found.");
}

// Fetch the result
$inbox = $result->fetch_assoc();


view('admin-inbox/inbox.view.php',[
    'inbox' => $inbox
]);



// Clean up
$stmt->close();
$conn->close();