<?php
require base_path('db/config.php');


if (!isset($_SESSION['user_id'])) {
    header("Location: ../views_components/login.php");
    exit;
}

$sender_id = $_SESSION['user_id'];
$draft_id = $_GET['draft_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiver_email = $_POST['receiver_email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $is_draft = isset($_POST['save_as_draft']) ? 1 : 0; // Check if the message is still a draft

    // Get receiver_id from receiver_email
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $receiver_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $receiver = $result->fetch_assoc();
    $stmt->close();

    if (!$receiver) {
        echo '<script type="text/javascript">
                alert("Receiver not found.");
                window.location.href = "../views_components/dashboard.php";
              </script>';
        exit;
    }

    $receiver_id = $receiver['id'];

    // Update the draft in the mails table
    $sql = "UPDATE mails SET sender_id = ?, receiver_id = ?, subject = ?, body = ?, is_draft = ?, created_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissii", $sender_id, $receiver_id, $subject, $body, $is_draft, $draft_id);
    $stmt->execute();
    $stmt->close();

    // Only insert into user_mail_status for receiver if it's not a draft
    if (!$is_draft) {
        $sql = "INSERT INTO user_mail_status (mail_id, user_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $draft_id, $receiver_id);
        $stmt->execute();
        $stmt->close();

        echo '<script type="text/javascript">
                alert("Message sent successfully!");
                window.location.href = "../views_components/dashboard.php";
              </script>';
    } else {
        echo '<script type="text/javascript">
                alert("Draft saved successfully!");
                window.location.href = "../views_components/dashboard.php";
              </script>';
    }
}

// Fetch the draft details
$sql = "SELECT * FROM mails WHERE id = ? AND sender_id = ? AND is_draft = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $draft_id, $sender_id);
$stmt->execute();
$result = $stmt->get_result();
$draft = $result->fetch_assoc();
$stmt->close();

if (!$draft) {
    echo '<script type="text/javascript">
            alert("Draft not found.");
            window.location.href = "../views_components/dashboard.php";
          </script>';
    exit;
}

// Fetch the receiver email
$sql = "SELECT email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $draft['receiver_id']);
$stmt->execute();
$result = $stmt->get_result();
$receiver = $result->fetch_assoc();
$stmt->close();

$receiver_email = $receiver ? $receiver['email'] : '';


view('mails/edit_draft.view.php',[
    'receiver' => $receiver
]);