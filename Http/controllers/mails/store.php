<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$users = $db->query('select * from users')->get();

foreach ($users as $user) {
    if ($user['email'] === $_SESSION['user']['email']) {
        $user_id = $user['id'];
    }  
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiver_email = $_POST['receiver_email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    // Lookup receiver_id based on email
    $sql = "SELECT id FROM users WHERE email = ?";
    $result = $db->query($sql, [$receiver_email])->statement->fetch();

    if ($result) {
        $receiver_id = $result['id'];
        $sql = "INSERT INTO mails (sender_id, receiver_id, subject, body) VALUES (?, ?, ?, ?)";
        $params = [$user_id, $receiver_id, $subject, $body];
        $db->query($sql, $params);
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Message Sent',
            text: 'You have successfull sent a message.'
        }).then(function() {
            window.history.back(); // Go back to the previous page
        });
      </script>";

    } else {
        echo "Error: User with email " . htmlspecialchars($receiver_email) . " not found.";
    }
}


if (!empty($errors)) {
    return view("mails/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}



header('location: /mails');
die();
