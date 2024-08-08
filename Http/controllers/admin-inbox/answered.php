<?php
require base_path('db/config.php');

// Define the query to get the latest message for each user with role_id = 2
$sql = "SELECT m.id, m.body, m.created_at, m.sender_id, 
       CONCAT(u.fname, ' ' , u.lname) AS sender_name,
       CONCAT(c.fname, ' ' , c.lname) AS receiver_name
FROM mails m
JOIN clients c ON m.sender_id = c.id
JOIN users u ON m.receiver_id = u.id
WHERE m.is_answered = TRUE" ;

// Execute the query
$result = $conn->query($sql);



view('admin-inbox/answered.view.php', [
  'result' => $result
]);

// Close the connection
$conn->close();
