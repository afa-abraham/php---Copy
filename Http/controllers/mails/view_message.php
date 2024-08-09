<?php
require base_path('db/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views_components/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$type = isset($_GET['type']) ? $_GET['type'] : '';

if ($message_id === 0) {
    echo "Invalid message ID";
    exit;
}

// Mark the message as read in both tables
if ($type === 'inbox') {
    // Update the mails table
    $sql = "UPDATE mails SET is_read = 1 WHERE id = ? AND receiver_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $message_id, $user_id);
    $stmt->execute();
    $stmt->close();
    
    // Update the user_mail_status table
    $sql = "UPDATE user_mail_status SET is_read = 1 WHERE mail_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $message_id, $user_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch the thread ID of the message
$sql = "SELECT thread_id FROM mails WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $message_id);
$stmt->execute();
$result = $stmt->get_result();
$thread = $result->fetch_assoc();
$thread_id = $thread['thread_id'];
$stmt->close();

// Fetch the messages in the thread
$sql = "SELECT mails.*, CONCAT(sender.fname, ' ', sender.lname) AS sender_name, sender.profile_image AS sender_image, sender.email AS sender_email, CONCAT(receiver.fname,' ',receiver.lname) AS receiver_name, receiver.email AS receiver_email 
        FROM mails 
        JOIN users AS sender ON mails.sender_id = sender.id 
        JOIN users AS receiver ON mails.receiver_id = receiver.id 
        WHERE mails.thread_id = ? 
        ORDER BY mails.created_at";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $thread_id);
$stmt->execute();
$result = $stmt->get_result();

// Initialize the last message sender details
$last_sender_email = null;
$last_subject = null;


view('mails/view_message.view.php',[
    'result' => $result
]);
