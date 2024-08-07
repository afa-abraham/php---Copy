<?php
require base_path('db/config.php');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch unread messages with sender and receiver details
$sql = "
    SELECT 
        m.id, 
        CONCAT(u.first_name, ' ', u.last_name) AS sender_name, 
        m.sender_id, 
        m.body, 
        m.receiver_id,
        CONCAT(c.fname, ' ', c.lname) AS receiver_name
    FROM 
        mails m
    JOIN 
        users u ON m.sender_id = u.id
    JOIN 
        clients c ON m.receiver_id = c.id
    WHERE 
        u.role_id = 2 
        AND m.is_read = 0
";

// Prepare and execute the query
$result = $conn->query($sql);

view('admin-inbox/unread.view.php',[
    'result' => $result
]);


// Close the database connection
$conn->close();
?>
