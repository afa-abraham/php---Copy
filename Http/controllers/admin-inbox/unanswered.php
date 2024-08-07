<?php
require base_path('db/config.php');

// Define the query to get the latest message for each user with role_id = 2
$sql = "SELECT m.id, m.body, m.created_at, m.sender_id, 
       CONCAT(u.first_name, ' ' , u.last_name) AS sender_name,
       CONCAT(c.fname, ' ' , c.lname) AS receiver_name
FROM mails m
JOIN users u ON m.sender_id = u.id
JOIN clients c ON m.receiver_id = c.id
WHERE u.role_id = 2
  AND m.created_at = (
      SELECT MAX(m2.created_at)
      FROM mails m2
      WHERE m2.sender_id = m.sender_id
  )
ORDER BY m.created_at DESC";

// Execute the query
$result = $conn->query($sql);



view('admin-inbox/unanswered.view.php', [
  'result' => $result
]);

// Close the connection
$conn->close();
