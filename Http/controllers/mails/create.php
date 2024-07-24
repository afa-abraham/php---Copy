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
    $result = $db ->query("SELECT id FROM users WHERE email = :email" ,[
        'email' => $receiver_email
    ])->findOrFail();
    

    dd($result);
 
    

    if ($result) {
        $receiver_id = $result['id'];
        $db ->query ("INSERT INTO mails where sender_id = :sender_id, receiver_id = :receiver_id, subject = :subject, body = :body ",[
            'sender_id' => $user_id,
            'receiver_id' => $receiver_id ,
            'subject' => $subject,
            'body' => $body
        ]);

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

view("mails/create.view.php", [
    'heading' => 'Create a new message',
    'errors' => []
]);