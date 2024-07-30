<?php
require base_path('db/config.php');


if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}


$sender_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiver_email = $_POST['receiver_email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $is_draft = isset($_POST['save_as_draft']) ? 1 : 0;
    $thread_id = $_POST['thread_id'] ?? null;

    // Get receiver_id from receiver_email
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $receiver_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $receiver = $result->fetch_assoc();
    $stmt->close();

    if (!$receiver) {
        echo "<script>Swal.fire({
                title: 'Opsss',
                text: 'Receiver not found.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(function() {
            window.history.back(); // Go back to the previous page
        }); </script>" ;
        exit;
    }

    $receiver_id = $receiver['id'];

    // Insert into mails table
    $sql = "INSERT INTO mails (sender_id, receiver_id, subject, body, is_draft, created_at, thread_id) VALUES (?, ?, ?, ?, ?, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissii", $sender_id, $receiver_id, $subject, $body, $is_draft, $thread_id);
    $stmt->execute();
    $mail_id = $stmt->insert_id;
    $stmt->close();

    // Update thread_id to be the mail_id for the first message in the thread
    if (!$thread_id) {
        $sql = "UPDATE mails SET thread_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $mail_id, $mail_id);
        $stmt->execute();
        $stmt->close();
    }

    // Insert into user_mail_status table for sender
    $sql = "INSERT INTO user_mail_status (mail_id, user_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $mail_id, $sender_id);
    $stmt->execute();
    $stmt->close();

 

    // Only insert into user_mail_status for receiver if it's not a draft
    if (!$is_draft) {
        $sql = "INSERT INTO user_mail_status (mail_id, user_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $mail_id, $receiver_id);
        $stmt->execute();
        $stmt->close();

        echo "<script>Swal.fire({
                title: 'Success',
                text: 'Message sent successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function() {
            window.history.back(); // Go back to the previous page
        }); </script>" ;
    } else {
        header('location: /mails/drafts');
        echo `
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: 'You have no access to this page.'
        }).then(function() {
            window.history.back(); 
        });
      </script>`;
    }
}


view('mails/send_mail.view.php',[

]);

