<?php
include("DBConnection.php");

// Retrieve user inputs
$fromUser = $_POST["fromUser"];
$toUser = $_POST["toUser"];
$output = "";

// Prepare the SQL statement to avoid SQL injection
$stmt = $connect->prepare("
    SELECT * FROM messages 
    WHERE (FromUser = ? AND ToUser = ?) 
    OR (FromUser = ? AND ToUser = ?)
");

// Check if the statement was prepared successfully
if ($stmt === false) {
	die("Error preparing the statement: " . htmlspecialchars($connect->error));
}

// Bind the parameters
$stmt->bind_param("ssss", $fromUser, $toUser, $toUser, $fromUser);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetch and display results
while ($chat = $result->fetch_assoc()) {
	// Escape message content to prevent XSS attacks
	$message = htmlspecialchars($chat["Message"], ENT_QUOTES, 'UTF-8');

	if ($chat["FromUser"] == $fromUser) {
		$output .= "<div style='text-align:right;'>
            <p style='background-color:lightblue; word-wrap:break-word;display:inline-block;padding:5px;border-radius:10px;max-width:70%;'>
            $message
            </p>
            </div>";
	} else {
		$output .= "<div style='text-align:left;'>
            <p style='background-color:yellow; word-wrap:break-word;display:inline-block;padding:5px;border-radius:10px;max-width:70%;'>
            $message
            </p>
            </div>";
	}
}

// Close the statement
$stmt->close();

// Output result
echo $output;
