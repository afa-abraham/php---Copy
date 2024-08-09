
<?php require base_path('db/config.php');
 
foreach ($users as $user) {
    if ($user['email'] === $_SESSION['user']['email']) {
        $_SESSION['user_id'] = $user['id'];
        break;
    }
}



if (!isset($_SESSION['user_id'])) {
   header("Location: /login");
    exit;
}

$user_id = $_SESSION['user_id'];

//Inbox Query
$sql = "SELECT MAX(mails.id) as id, mails.thread_id, mails.body, mails.created_at, CONCAT(sender.fname, ' ', sender.lname) AS sender_name, sender.profile_image AS sender_image 
        FROM mails 
        JOIN users AS sender ON mails.sender_id = sender.id 
        WHERE mails.receiver_id = ? 
        GROUP BY mails.thread_id 
        ORDER BY MAX(mails.created_at) DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result(); 


view('mails/inbox.view.php',[
    'result' => $result
]);

 
$stmt->close();
?>
