<?php
require base_path('db/config.php');


// Execute the query
$result = $conn->query('SELECT * FROM users');

// Check if the query was successful
if ($result) {
    // Fetch all rows as an associative array
    $users = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Handle query error
    echo "Query Error: " . $conn->error;
}

// Free result set
$result->free();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views_components/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];

//Sent Query
$sql = "SELECT MAX(mails.id) as id, mails.thread_id, mails.subject, mails.created_at, receiver.username AS receiver_name, receiver.profile_image AS receiver_image 
        FROM mails 
        JOIN users AS receiver ON mails.receiver_id = receiver.id 
        JOIN user_mail_status ON mails.id = user_mail_status.mail_id 
        WHERE mails.sender_id = ? AND user_mail_status.user_id = ? 
        AND user_mail_status.is_deleted = 0 AND user_mail_status.is_archived = 0 
        GROUP BY mails.thread_id 
        ORDER BY MAX(mails.created_at) DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

$isAdmin = ($role_id == 1);


view('mails/sent.view.php',[
    'result' => $result
]);


$stmt->close();
