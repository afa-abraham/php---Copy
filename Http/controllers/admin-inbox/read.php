<?php
require base_path('db/config.php');

// SQL query to fetch unread messages with sender and receiver details
$sql = "
    SELECT m.id, CONCAT(u.first_name, ' ', u.last_name) AS sender_name,m.sender_id, m.body, m.receiver_id
    FROM mails m
    JOIN users u ON m.sender_id = u.id
    WHERE u.role_id = 2 AND m.is_read = 1
";

// Prepare and execute the query
$result = $conn->query($sql);

view('admin-inbox/read.view.php',[
    'result' => $result
]);


// Close the database connection
$conn->close();
?>
