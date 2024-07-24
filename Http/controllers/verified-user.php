<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$users = $db->query('select * from users')->get();

foreach ($users as $user) {
    if ($user['email'] === $_SESSION['user']['email']) {
        $sender_id = $user['id'];
    }  
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiver_email = $_POST['receiver_email'];
    $body = $_POST['body'];
    $is_draft = isset($_POST['save_as_draft']) ? 1 : 0;

   $receiver =$db -> query('SELECT id FROM users where email = :email', [
        'receiver_email' => $receiver_email
    ]) -> findOrFail();

    if(!$receiver) {
        echo '<script>
            Swal.fire({
    icon: "error",
    title: "Oops...",
    text: "Receiver not found",
  });
        </script>';
        exit();
    }

    $receiver_id = $receiver['id'];

    // Insert into mails table

    $mail_id = $db->query("INSERT INTO mails (sender_id, receiver_id, body, is_draft, created_at) 
    VALUES (:sender_id, :receiver_id, :body, :is_draft, NOW())",
    [
        'sender_id' => $sender_id,
        'receiver_id' => $receiver_id,
        'body' => $body,
        'is_draft' => $is_draft
    ])->lastInsertId();

        // Insert into user_mail_status table for sender
        $db ->query("INSERT INTO user_mail_status mail_id = :mail_id, user_id= :user_id",[
            'mail_id' => $mail_id,
            'user_id' => $sender_id
        ]) ;

}

view('verified-user.view.php',[
    'users' => $users
]);

