
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['archive_mail_id'])) {
    $mail_id = $_POST['archive_mail_id'];
    $db ->query("UPDATE mails SET archived = 1 WHERE id = :id AND receiver_id = :receiver_id",[
        $mail_id, $user_id
    ]);
  

    // Reload the page to reflect changes
    header("Location: /mails");
    exit;
}


$result = $db->query("
    SELECT MAX(mails.id) as id, mails.thread_id, mails.subject, mails.created_at
    FROM mails 
    JOIN users AS sender ON mails.sender_id = sender.id 
    JOIN user_mail_status ON mails.id = user_mail_status.mail_id 
    WHERE mails.receiver_id = ? AND user_mail_status.user_id = ? 
    AND user_mail_status.is_deleted = 0 AND user_mail_status.is_archived = 0 
    GROUP BY mails.thread_id 
    ORDER BY MAX(mails.created_at) DESC",
    [$user_id, $user_id]
)->findOrFail();




view('index.view.php',[
    'users' => $users
]);

?>
