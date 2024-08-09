
<?php
require base_path('db/config.php');



// Assume $message_id is the ID of the message to mark as read
$message_id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Sanitize input


// Prepare the SQL statement
$sql = "UPDATE mails SET is_read = 1 WHERE id = ?";

// Initialize a prepared statement
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

// Bind the parameter (message_id)
$stmt->bind_param('i', $message_id);

// Execute the statement
if ($stmt->execute()) {
} else {
    echo "Error: " . $stmt->error;
}

$sql = "SELECT thread_id FROM mails WHERE id =?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}


$message_id = $_GET['id'];
$stmt->bind_param("i", $message_id); 
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$thread_id = $row['thread_id'];

// Fetch the record with the given ID and email
$sql = "SELECT 
            m.id, 
            CONCAT(sender.fname, ' ', sender.lname) AS sender_name, 
            m.body AS message_body, 
            m.created_at AS sent_at, 
            CONCAT(receiver.fname, ' ', receiver.lname) AS receiver_name, 
            receiver.email AS receiver_email
        FROM 
            mails m
        JOIN 
            users sender ON m.sender_id = sender.id
        JOIN 
            users receiver ON m.receiver_id = receiver.id
        WHERE 
            m.thread_id = ? 
        ORDER BY 
            m.created_at ASC";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $thread_id); 
$stmt->execute();
$result = $stmt->get_result();

$messages = $result->fetch_all(MYSQLI_ASSOC);


if (empty($messages)) {
    die("No messages found for this thread.");
}

view('admin-inbox/inbox.view.php',[
    'messages' => $messages
]);



// Clean up
$stmt->close();
$conn->close();
