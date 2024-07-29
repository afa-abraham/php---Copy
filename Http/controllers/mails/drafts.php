<?php
require base_path('db/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views_components/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch drafts with receiver's name
$sql = "SELECT mails.*, users.username AS receiver_name 
        FROM mails 
        LEFT JOIN users ON mails.receiver_id = users.id 
        WHERE mails.sender_id = ? AND mails.is_draft = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

view('mails/drafts.view.php',[
    'result' => $result
]);