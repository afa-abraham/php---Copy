<?php
require base_path('db/config.php');

// SQL query to fetch unread messages with sender and receiver details
$sql = "
    SELECT m.id, CONCAT(u1.fname, ' ', u1.lname) AS sender_name,
    CONCAT(u2.fname, ' ', u2.lname) AS receiver_name,
    m.sender_id, m.body, m.receiver_id
    FROM mails m
    JOIN users u1 ON m.sender_id = u1.id
    JOIN users u2 ON m.receiver_id = u2.id
    WHERE u1.role_id = 2 AND m.is_read = 1
";

// Prepare and execute the query
$result = $conn->query($sql);

view('admin-inbox/read.view.php',[
    'result' => $result
]);


// Close the database connection
$conn->close();
?>
