<?php
session_start();
include("DBConnection.php");

// Get user inputs from POST request
$fromUser = $_POST['fromUser'];
$toUser = $_POST['toUser'];
$message = $_POST['message'];

// Prepare an SQL statement
$stmt = $connect->prepare("INSERT INTO messages (FromUser, ToUser, Message) VALUES (?, ?, ?)");

// Check if the statement was prepared successfully
if ($stmt === false) {
     echo "Error preparing the statement: " . htmlspecialchars($connect->error);
     exit();
}

// Bind the parameters to the statement
$stmt->bind_param("sss", $fromUser, $toUser, $message);

// Execute the statement
if ($stmt->execute()) {
     $output = "Message sent successfully.";
} else {
     $output = "Error. Please try again.";
}

// Close the statement
$stmt->close();

// Output result
echo $output;
