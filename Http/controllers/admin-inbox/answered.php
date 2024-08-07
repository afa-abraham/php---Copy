<?php
require base_path('db/config.php');

// Define the query to get the latest message for each user with role_id = 2
$sql = "SELECT m.id, m.body, m.created_at, m.receiver_id, 
       CONCAT(u.first_name, ' ' , u.last_name) AS receiver_name
FROM mails m
JOIN users u ON m.receiver_id = u.id
WHERE u.role_id = 2
ORDER BY m.created_at DESC";

// Execute the query
$result = $conn->query($sql);



view('admin-inbox/answered.view.php', [
  'result' => $result
]);

// Close the connection
$conn->close();
