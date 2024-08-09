<?php

require base_path('db/config.php');

// Securely fetch the user ID from the session
$user_id = $_SESSION['user_id'];

// SQL query to fetch unread messages with sender and receiver details
$sql = "
    SELECT m.id, CONCAT(u1.fname, ' ', u1.lname) AS sender_name,
    CONCAT(u2.fname, ' ', u2.lname) AS receiver_name,
    m.sender_id, m.body, m.receiver_id,m.created_at
    FROM mails m
    JOIN users u1 ON m.sender_id = u1.id
    JOIN users u2 ON m.receiver_id = u2.id
    WHERE u1.role_id = 4 AND m.is_read = 0 AND u2.id = ?
";

// Prepare the query
$stmt = $conn->prepare($sql);

// Bind the user ID parameter
$stmt->bind_param('i', $user_id);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Pass the result to the view
view('mails/unread.view.php', [
    'result' => $result
]);

// Close the statement and database connection
$stmt->close();
$conn->close();




