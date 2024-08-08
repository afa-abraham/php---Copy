<?php
require base_path('db/config.php');

// Define the query to get the latest message for each user with role_id = 2
$sql = "SELECT m.id, m.body, m.created_at, m.sender_id, m.receiver_id, m.thread_id,
       CONCAT(sender.fname, ' ', sender.lname) AS sender_name,
       CONCAT(receiver.fname, ' ', receiver.lname) AS receiver_name
FROM mails m
JOIN users sender ON m.sender_id = sender.id
JOIN users receiver ON m.receiver_id = receiver.id
WHERE sender.role_id = 2
  AND m.created_at = (
      SELECT MAX(m2.created_at)
      FROM mails m2
      WHERE m2.sender_id = m.sender_id
        AND m2.thread_id = m.thread_id
  )
ORDER BY m.created_at DESC";


// Execute the query
$result = $conn->query($sql);


view('admin-inbox/unanswered.view.php', [
  'result' => $result
]);

// Close the connection
$conn->close();
